<?php

namespace Member\Service;

use INUtils\Singleton\AbstractSingleton;

/**
 *
 * @author jdelahoz1
 *
 */
class MemberService extends AbstractSingleton {
    
    /**
     * 
     * @var string
     */
    private $role = "";

    /**
     * 
     * @var string
     */
    private $metaKey = "";
    
    /**
     * 
     * @var string
     */
    private $metaValue = "";
    
    /**
     * 
     * @var string
     */
    private $metaCompare = "";
    
    /**
     * 
     * @var array
     */
    private $metaQuery = array();
    
    /**
     * 
     * @var array
     */
    private $dateQuery = array();
    
    /**
     * 
     * @var array
     */
    private $include = array();
    
    /**
     * 
     * @var array
     */
    private $exclude = array();
    
    /**
     * 
     * @var string
     */
    private $orderby = "login";
    
    /**
     * 
     * @var string
     */
    private $order = "ASC";
    
    /**
     * 
     * @var string
     */
    private $offset = "";
    
    /**
     * 
     * @var string
     */
    private $search = "";
    
    /**
     * 
     * @var string
     */
    private $number = 20;
    
    /**
     * 
     * @var boolean
     */
    private $countTotal = true;
    
    /**
     * 
     * @var string
     */
    private $fields = "all";
    
    /**
     * 
     * @var string
     */
    private $who = "";
    
    /**
     * @return array
     */
    public function getArgsArray(){
        $args = array(
            'role'         => $this->role,
            'meta_query'   => $this->metaQuery,
            'orderby'      => $this->orderby,
            'order'        => $this->order,
            'offset'       => $this->offset,
            'search'       => "*".$this->search."*",
            'number'       => $this->number,
            'count_total'  => $this->countTotal,
        );
        
        if($this->metaKey != ""){
            $args["meta_key"] = $this->metaKey;
        }
        
        if($this->metaValue != ""){
            $args["meta_value"] = $this->metaValue;
        }
        
        if($this->metaCompare != ""){
            $args["meta_compare"] = $this->metaCompare;
        }
        
        return $args;
    }
    
    /**
     * @return \WP_User_Query
     */
    public function getUsers(){
        $users = new \WP_User_Query($this->getArgsArray());
        return $users;
    }

    /**
     *
     * @return the string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     *
     * @param
     *            $role
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     *
     * @return the string
     */
    public function getMetaKey()
    {
        return $this->metaKey;
    }

    /**
     *
     * @param
     *            $metaKey
     */
    public function setMetaKey($metaKey)
    {
        $this->metaKey = $metaKey;
        return $this;
    }

    /**
     *
     * @return the string
     */
    public function getMetaValue()
    {
        return $this->metaValue;
    }

    /**
     *
     * @param
     *            $metaValue
     */
    public function setMetaValue($metaValue)
    {
        $this->metaValue = $metaValue;
        return $this;
    }

    /**
     *
     * @return the string
     */
    public function getMetaCompare()
    {
        return $this->metaCompare;
    }

    /**
     *
     * @param
     *            $metaCompare
     */
    public function setMetaCompare($metaCompare)
    {
        $this->metaCompare = $metaCompare;
        return $this;
    }

    /**
     *
     * @return the array
     */
    public function getMetaQuery()
    {
        return $this->metaQuery;
    }

    /**
     *
     * @param array $metaQuery            
     */
    public function setMetaQuery(array $metaQuery)
    {
        $this->metaQuery = $metaQuery;
        return $this;
    }

    /**
     *
     * @return the array
     */
    public function getDateQuery()
    {
        return $this->dateQuery;
    }

    /**
     *
     * @param array $dateQuery            
     */
    public function setDateQuery(array $dateQuery)
    {
        $this->dateQuery = $dateQuery;
        return $this;
    }

    /**
     *
     * @return the array
     */
    public function getInclude()
    {
        return $this->include;
    }

    /**
     *
     * @param array $include            
     */
    public function setInclude(array $include)
    {
        $this->include = $include;
        return $this;
    }

    /**
     *
     * @return the array
     */
    public function getExclude()
    {
        return $this->exclude;
    }

    /**
     *
     * @param array $exclude            
     */
    public function setExclude(array $exclude)
    {
        $this->exclude = $exclude;
        return $this;
    }

    /**
     *
     * @return the string
     */
    public function getOrderby()
    {
        return $this->orderby;
    }

    /**
     *
     * @param
     *            $orderby
     */
    public function setOrderby($orderby)
    {
        $this->orderby = $orderby;
        return $this;
    }

    /**
     *
     * @return the string
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     *
     * @param
     *            $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     *
     * @return the string
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     *
     * @param
     *            $offset
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     *
     * @return the string
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     *
     * @param
     *            $search
     */
    public function setSearch($search)
    {
        $this->search = $search;
        return $this;
    }

    /**
     *
     * @return the string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     *
     * @param
     *            $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     *
     * @return the boolean
     */
    public function getCountTotal()
    {
        return $this->countTotal;
    }

    /**
     *
     * @param
     *            $countTotal
     */
    public function setCountTotal($countTotal)
    {
        $this->countTotal = $countTotal;
        return $this;
    }

    /**
     *
     * @return the string
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     *
     * @param
     *            $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     *
     * @return the string
     */
    public function getWho()
    {
        return $this->who;
    }

    /**
     *
     * @param
     *            $who
     */
    public function setWho($who)
    {
        $this->who = $who;
        return $this;
    }
 

}
