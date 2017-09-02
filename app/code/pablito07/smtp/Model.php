<?php
/**
 * Mail Transport
 */
namespace pablit07\smtp\Model;
 
class Transport extends \Zend_Mail_Transport_Smtp implements \Magento\Framework\Mail\TransportInterface
{
    /**
     * @var \Magento\Framework\Mail\MessageInterface
     */
    protected $_message;
 
    /**
     * @param MessageInterface $message
     * @param null $parameters
     * @throws \InvalidArgumentException
     */
    public function __construct(\Magento\Framework\Mail\MessageInterface $message)
    {
        if (!$message instanceof \Zend_Mail) {
            throw new \InvalidArgumentException('The message should be an instance of \Zend_Mail');
        }
         $smtpHost= 'email-smtp.us-west-2.amazonaws.com';//your smtp host  ';
         $smtpConf = [
            'auth' => 'login',//auth type
            'tsl' => 'tsl', 
            'port' => '587',
            'username' => 'AKIAIJ5L3LEZLGBNCJ4A@email-smtp.us-west-2.amazonaws.com',//smtm user name
            'password' => 'AkmsAu3OBe1cH5ezgtuY1IVzVsGdCINvSfyIH3LuTOa4'//smtppassword 
         ];
 
        parent::__construct($smtpHost, $smtpConf);
        $this->_message = $message;
    }
 
    /**
     * Send a mail using this transport
     * @return void
     * @throws \Magento\Framework\Exception\MailException
     */
    public function sendMessage()
    {
        try {
            parent::send($this->_message);
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\MailException(new \Magento\Framework\Phrase($e->getMessage()), $e);
        }
    }
}