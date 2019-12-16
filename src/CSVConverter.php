<?php
	namespace App;

	use App\Exceptions\UserException;
	/**
	*
	*/
	class CSVConverter
	{
		private $file;
		private $tableName;
		private $mysqli;
		private $queryString;
		private $fields;
		private $outFile;
		function __construct(object $mysqli, string $filePath, string $tableName = null, array $fields = null)
		{
            if($mysqli->connect_error){
                throw new \mysqli_sql_exception("Connection error");
            }
            $this->mysqli = $mysqli;
            if(!file_exists($filePath)){
				throw new UserException("Given file does not exists - $filePath");
			}
			$this->file = new \SplFileObject($filePath);

			if($tableName === null){
                $tableName = $this->getTableName($filePath);
            }
			$this->tableName = $tableName;
			if($fields === null){
			    $fields = $this->getHeaders();
            }
			$this->fields = $fields;
            if(!$this->isValidTable()){
                throw new UserException("Not valid table name");
            }
            if(!$this->isValidFields()){
                throw new UserException("Not valid fields name");
            }
            if(!$this->isValidCountFields()){
                throw new UserException("Not valid count fields");
            }
            $this->queryString = $this->createInsertQuery();
		}
		private function getTableName(string $path):?string{
		    $tempArr = explode('/',$path);
		    $tempStr =  array_pop($tempArr);
		    //Если написать return array_pop(explode('/',$path)); - выдаёт Notice. Почему?
            $tempArr = explode('.',$tempStr);
            return $tempArr[0];
        }
        private function getHeaders():?array {
		    $this->file->rewind();
		    $data = $this->file->fgetcsv();
		    return $data;
        }
        private function getData():?array {
		    $result = null;
            $this->file->setFlags(\SplFileObject::READ_CSV | \SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);
            foreach ($this->file as $row){
                $result[] = $row;
            }
            return $result;
        }
        private function createInsertQuery():?string{
		    $count = count($this->fields);
		    if ($count === null) {
		        return $count;
            }
		    $queryString = "INSERT INTO `".$this->tableName."` (";
            foreach ($this->fields as $value){
                $queryString .= "`$value`";
                $count--;
                if($count === 0) {
                    $queryString .= ")";
                    break;
                }
                $queryString .=", ";
            }
            $countData = count($this->getData());
            $flag = false;
            $queryString .= " VALUES ";
            foreach ($this->getData() as $oneArr) {
                if ($flag === false) {
                    $flag = true;
                    $countData--;
                    continue;
                }
                $queryString .= "(";
                foreach ($oneArr as $value) {
                    $queryString .= "'$value',";
                }
                $queryString = substr($queryString,0,-1);
                $queryString .= "),";
                $countData--;
                if($countData === 0){
                    $queryString = substr($queryString,0,-1);
                    break;
                }
            }
            return $queryString;
		}
        private function isValidTable():bool{
		    $isValid = false;
            $res = $this->mysqli->query("SHOW TABLES");
            while($row = $res->fetch_array( MYSQLI_NUM)) {
                if($row[0] === $this->tableName){
                    $isValid = true;
                    break;
                }
            }
            return $isValid;
        }
        private function isValidFields():bool{
            $isValid = true;
            $tempQuery = "DESCRIBE ".$this->tableName;
            $res = $this->mysqli->query($tempQuery);
            $tempArr = [];
            while($row = $res->fetch_array( MYSQLI_NUM)) {
                $tempArr[] = $row[0];
            }
            foreach ($this->fields as $headVal){
                if(!in_array($headVal,$tempArr)){
                    $isValid = false;
                }
            }
            return $isValid;
        }
        private function isValidCountFields():bool{
		    return count($this->fields) === count($this->getHeaders());
        }
        public function getInsertString():?string{
            return $this->queryString;
        }
        public function createInsertFile(string $queryString, string $path){
            if(!file_exists($path)){
                $fp = fopen($path,'w');
                fclose($fp);
            }
            $this->outFile = new \SplFileObject($path,'w');
            $this->outFile->fwrite($queryString);
        }
        public function getTableNamePublic():?string{
		    return $this->tableName;
        }
    }

