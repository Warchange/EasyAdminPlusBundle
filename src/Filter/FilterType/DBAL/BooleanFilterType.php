<?php

namespace Lle\EasyAdminPlusBundle\Filter\FilterType\DBAL;

use Symfony\Component\HttpFoundation\Request;

/**
 * BooleanFilterType
 */
class BooleanFilterType extends AbstractDBALFilterType
{
    /**
     * @param Request $request  The request
     * @param array   &$data    The data
     * @param string  $uniqueId The unique identifier
     */
    public function bindRequest(Request $request, array &$data, $uniqueId)
    {
        $data['value'] = $request->query->get('filter_value_' . $uniqueId);
        return ($data['value'] != '');
    }

    /**
     * @param array  $data     The data
     * @param string $uniqueId The unique identifier
     */
    public function apply(array $data, $uniqueId)
    {
        if (isset($data['value'])) {
            switch ($data['value']) {
                case 'true':
                    $this->queryBuilder->andWhere($this->queryBuilder->expr()->eq($this->getAlias() . $this->columnName, 'true'));
                    break;
                case 'false':
                    $this->queryBuilder->andWhere($this->queryBuilder->expr()->eq($this->getAlias() . $this->columnName, 'false'));
                    break;
            }
        }
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'LleEasyAdminPlusBundle:FilterType:booleanFilter.html.twig';
    }
}
