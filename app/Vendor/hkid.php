<?
class HKID {
    var $HKID_str;
    var $digits;

    function HKID()
    {
        $this->digits=array();
        $this->HKID_str='';
        $this->digits['a2']=' ';
        $this->digits['a1']=' ';
        $this->digits['d6']=0;
        $this->digits['d5']=0;
        $this->digits['d4']=0;
        $this->digits['d3']=0;
        $this->digits['d2']=0;
        $this->digits['d1']=0;
        $this->digits['c']='';
    }

    function set($HKID_str)
    {
        $matches=array();
        if (preg_match('/([A-Z,a-z,\s])?([A-Z,a-z])\s*(\d{6})\s*(\([0-9,A,a]\))?/', $HKID_str, $matches)) {
            if((isset($matches[1]))&&($matches[1]!='')) $this->digits['a2']=strtoupper($matches[1]);
            if((isset($matches[2]))&&($matches[2]!='')) $this->digits['a1']=strtoupper($matches[2]);
            if((isset($matches[3]))&&($matches[3]!='')) {
                $this->digits['d6']=substr($matches[3],0,1);
                $this->digits['d5']=substr($matches[3],1,1);
                $this->digits['d4']=substr($matches[3],2,1);
                $this->digits['d3']=substr($matches[3],3,1);
                $this->digits['d2']=substr($matches[3],4,1);
                $this->digits['d1']=substr($matches[3],5,1);
            }
            if((isset($matches[4]))&&($matches[4]!='')) $this->digits['c']=strtoupper(substr($matches[4],1,1));
        };
        $this->HKID_str=$this->digits['a2'].$this->digits['a1']
            .$this->digits['d6'].$this->digits['d5'].$this->digits['d4'].$this->digits['d3'].$this->digits['d2'].$this->digits['d1'];
        if ($this->digits['c']!='') {
            $this->HKID_str .= "(".$this->digits['c'].")";
        }
    }

    function alphamap($ch)
    {
        if ($ch==' ') return 36;
        return (ord(strtoupper($ch))-ord('A')+10);
    }

    function check_digit()
    {
        $o_chk=0;
        $sum=0;
        $sum=
            (($this->alphamap($this->digits['a2']))*9)
            + (($this->alphamap($this->digits['a1']))*8)
            + (($this->digits['d6'])*7)
            + (($this->digits['d5'])*6)
            + (($this->digits['d4'])*5)
            + (($this->digits['d3'])*4)
            + (($this->digits['d2'])*3)
            + (($this->digits['d1'])*2);
        $o_chk = (11 - ($sum % 11))%11;
        if ($o_chk==10) $o_chk='A';
        return $o_chk;
    }

    function validate()
    {
        return (($this->check_digit())==($this->digits['c']));
    }
}
?>