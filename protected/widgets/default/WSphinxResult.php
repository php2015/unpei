<?php

/**
 * CSqlDataProvider implements a data provider based on a plain SQL statement.
 *
 * CSqlDataProvider provides data in terms of arrays, each representing a row of query result.
 *
 * Like other data providers, CSqlDataProvider also supports sorting and pagination.
 * It does so by modifying the given {@link sql} statement with "ORDER BY" and "LIMIT"
 * clauses. You may configure the {@link sort} and {@link pagination} properties to
 * customize sorting and pagination behaviors.
 *
 * CSqlDataProvider may be used in the following way:
 * <pre>
 * $count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM tbl_user')->queryScalar();
 * $sql='SELECT * FROM tbl_user';
 * $dataProvider=new CSqlDataProvider($sql, array(
 *     'totalItemCount'=>$count,
 *     'sort'=>array(
 *         'attributes'=>array(
 *              'id', 'username', 'email',
 *         ),
 *     ),
 *     'pagination'=>array(
 *         'pageSize'=>10,
 *     ),
 * ));
 * // $dataProvider->getData() will return a list of arrays.
 * </pre>
 *
 * Note: if you want to use the pagination feature, you must configure the {@link totalItemCount} property
 * to be the total number of rows (without pagination). And if you want to use the sorting feature,
 * you must configure {@link sort} property so that the provider knows which columns can be sorted.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @version $Id: CSqlDataProvider.php 2820 2011-01-06 17:15:56Z mdomba $
 * @package system.web
 * @since 1.1.4
 */
class WSphinxResult extends CDataProvider {

    /**
     * @var array parameters (name=>value) to be bound to the SQL statement.
     */
    public $queryStr;
    public $queryIndex = "test1";
    public $matchMode = SPH_MATCH_ALL;
    public $arrayResult = false;
    public $maxQueryTime = 3000;
    public $criteria;
    public $totalNum = 10000;

    /**
     * @var string the name of key field. Defaults to 'id'.
     */
    public $keyField = 'id';

    /**
     * Constructor.
     * @param string $sql the SQL statement to be used for fetching data rows.
     * @param array $config configuration (name=>value) to be applied as the initial property values of this class.
     */
    public function __construct($queryStr, $config = array()) {
//        $this->queryStr = $queryStr;
        $this->criteria = $queryStr;
        foreach ($config as $key => $value)
            $this->$key = $value;
    }

    protected function fetchData() {
        if($this->criteria->filters["make"]){
            $make = $this->criteria->filters["make"];
            $make_num = $make/1000000;
            $search = "search_".$make_num;
            $this->criteria->from = $this->criteria->from."_$make";
            $search = Yii::app()->{$search};
        }else{
           $search = Yii::App()->search;
        }
        $search->setArrayResult($this->arrayResult);
        $search->setMatchMode($this->matchMode);
        $search->setMaxQueryTime($this->maxQueryTime);

        if (($pagination = $this->getPagination()) !== false) {
            $pagination->setItemCount($this->getTotalItemCount());
            $limit = $pagination->getLimit();
            $offset = $pagination->getOffset();
            $this->criteria->paginator = $pagination;
        }
        $search->SetLimits($offset, $limit);
        $searchCriteria = $this->criteria;
        $rs = $search->searchRaw($searchCriteria);
        if ($rs["total_found"]) {
            $this->totalNum = $rs["total_found"];
        }
        return $rs["matches"];
    }

    /**
     * Fetches the data item keys from the persistent data storage.
     * @return array list of data item keys.
     */
    protected function fetchKeys() {
        $keys = array();
        foreach ($this->getData() as $i => $data)
            $keys[$i] = $data[$this->keyField];
        return $keys;
    }

    /**
     * Calculates the total number of data items.
     * This method is invoked when {@link getTotalItemCount()} is invoked
     * and {@link totalItemCount} is not set previously.
     * The default implementation simply returns 0.
     * You may override this method to return accurate total number of data items.
     * @return integer the total number of data items.
     */
    protected function calculateTotalItemCount() {
        return 0;
    }

    public function getTotalItemCount($refresh = false) {
        return $this->totalNum; //$this->getTotalItemCount();
    }

}
