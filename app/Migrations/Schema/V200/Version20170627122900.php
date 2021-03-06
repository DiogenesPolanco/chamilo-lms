<?php
/* For licensing terms, see /license.txt */

namespace Application\Migrations\Schema\V200;

use Application\Migrations\AbstractMigrationChamilo,
    Doctrine\DBAL\Schema\Schema,
    Chamilo\CoreBundle\Entity\ExtraField,
    Chamilo\CourseBundle\Entity\CSurvey;

/**
 * Class Version20170627122900
 * @package Application\Migrations\Schema\V200
 */
class Version20170627122900 extends AbstractMigrationChamilo
{

    /**
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function up(Schema $schema)
    {
        if (!api_get_configuration_value('survey_answered_at_field')) {
            return;
        }

        $em = $this->getEntityManager();

        /** @var ExtraField $extraField */
        $extraField = $em
            ->getRepository('ChamiloCoreBundle:ExtraField')
            ->findOneBy([
                'variable' => 'is_mandatory',
                'extraFieldType' => ExtraField::SURVEY_FIELD_TYPE
            ]);

        if (!$extraField) {
            return;
        }

        $surveys = $em
            ->createQuery('
                SELECT s FROM ChamiloCourseBundle:CSurvey s
                INNER JOIN ChamiloCoreBundle:ExtraFieldValues efv WITH s.iid = efv.item_id
                INNER JOIN ChamiloCoreBundle:ExtraField ef WITH efv.field = ef
                WHERE ef.variable = :variable
                    AND ef.extraFieldType = :ef_type
                    AND efv.value = 1
            ')
            ->setParameters([
                'variable' => 'is_mandatory',
                'ef_type' => ExtraField::SURVEY_FIELD_TYPE
            ])
            ->getResult();

        if (!$surveys) {
            return;
        }

        /** @var CSurvey $survey */
        foreach ($surveys as $survey) {
            $survey->setIsMandatory(true);

            $em->persist($survey);
        }

        $em->flush();
    }

    /**
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function down(Schema $schema)
    {
    }
}