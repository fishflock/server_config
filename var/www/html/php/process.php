<?php
/* An easy way to keep in track of external processes.
* @author: Peec
*/
class Process{
    private $pid;
    private $uid;
    private $spawnTime;
    private $fileName;
    private $filePath;
    private $binaryPath = "/var/www/html/GOBS/gobs";
    public function __construct($uid, $pid=null, $file_name=null, $spawn_time=null ){

        $this->uid = $uid;

        if($pid == null){ //new process
            $this->spawnTime = date(time());
            $this->fileName = $file_name;
            $this->filePath = "/var/www/html/hidden/uploads/" . $_SESSION['uid'] .'/'. $file_name;
            $this->runCom();
        }
        else{
            $this->setPid($pid);
            $this->spawnTime = $spawn_time;
            $this->fileName = $file_name;
            $this->filePath = "/var/www/html/hidden/uploads/" . $_SESSION['uid'] .'/'. $file_name;

        }
    }

    private function runCom(){
        //$command = 'nohup '.$this->binaryPath.' '. $this->filePath .' > /dev/null 2>&1 & echo $!';
        $command = 'nohup ls -la > /dev/null 2>&1 & echo $!';
        exec($command ,$op);
        $this->pid = (int)$op[0];
    }

    public function setPid($pid){
        $this->pid = $pid;
    }

    public function getPid(){
        return $this->pid;
    }

    public function status(){
        $command = 'ps -p '.$this->pid;
        exec($command,$op);
        if (!isset($op[1]))return false;
        else return true;
    }

    public function start(){
        if ($this->command != '')$this->runCom();
        else return true;
    }

    public function stop(){
        $command = 'kill '.$this->pid;
        exec($command);
        if ($this->status() == false)return true;
        else return false;
    }
}