<?php

/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Settings.php 9307 2011-09-22 00:26:32Z shaun $
 * @author     Jung
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Admin_Form_Mail_Settings extends Zend_Form
{

	public function init()
	{
		// Set form attributes
    
		$this->addElement('Text', 'contact', array(
			'label' => 'Contact Form Email',
			'description' => 'Enter the email address you want contact form messages to be sent to.',
			'decorators' => array(
							    'ViewHelper',
							    'Errors',
								array('Description', array('tag' => 'small', 'class' => 'description', 'style' => 'display : block')),
							    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'id' => 'contact-element', 'style' => 'width: 75%')),
							    array('Label', array('tag' => 'td', 'id' => 'contact-label')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr', 'id' => 'contact-wrapper'))),
			'attribs' => array('class' => 'text-input')
		));

		// Element: mail_name
		$this->addElement('Text', 'name', array(
			'label' => 'From Name',
			'description' => 'Enter the name you want the emails from the system to come from in the field below.',
			'value' => 'Site Admin',
			'decorators' => array(
							    'ViewHelper',
							    'Errors',
								array('Description', array('tag' => 'small', 'class' => 'description', 'style' => 'display : block')),
							    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'id' => 'name-element')),
							    array('Label', array('tag' => 'td', 'id' => 'name-label')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr', 'id' => 'name-wrapper'))),
			'attribs' => array('class' => 'text-input')
		));

		// Element: mail_from
		$this->addElement('Text', 'from', array(
			'label' => 'From Address',
			'description' => 'Enter the email address you want the emails from the system to come from in the field below.',
			'value' => 'no-reply@' . $_SERVER['HTTP_HOST'],
			'decorators' => array(
							    'ViewHelper',
							    'Errors',
								array('Description', array('tag' => 'small', 'class' => 'description', 'style' => 'display : block')),
							    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'id' => 'from-element')),
							    array('Label', array('tag' => 'td', 'id' => 'from-label')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr', 'id' => 'from-wrapper'))),
			'attribs' => array('class' => 'text-input')
		));

		$mailSmtpOptions = array(
			"multiOptions" => array(
				'0' => 'Use the built-in mail() function',
				'1' => 'Send emails through an SMTP server',
									
		));	
		$mail_smtp = new Zend_Form_Element_Radio('mail_smtp',$mailSmtpOptions);
		$mail_smtp->setRequired(true)
				  ->setLabel('Send through SMTP')
				  ->setDescription('Emails typically get sent through the web server using the PHP mail() function.  Alternatively you can have emails sent out using SMTP, usually requiring a username and password, and optionally using an external mail server.')
				  ->setValue('0')
				  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array('Description', array('tag' => 'small', 'class' => 'description', 'style' => 'display : block')),
							    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'id' => 'mail_smtp-element')),
							    array('Label', array('tag' => 'td', 'id' => 'mail_smtp-label')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr', 'id' => 'mail_smtp-wrapper', 'class' => 'radio_inline'))))
				  ->setAttribs(array('id' => 'mail_smtp'));	   				  
		$this->addElement($mail_smtp);		  		
		
		// Element: mail_smtp_server
		$this->addElement('Text', 'mail_smtp_server', array(
			'label' => 'SMTP Server Address',
			'required' => false,
			'value' => '127.0.0.1',
			'decorators' => array(
							    'ViewHelper',
							    'Errors',
								array('Description', array('tag' => 'small', 'class' => 'description', 'style' => 'display : block')),
							    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'id' => 'mail_smtp_server-element')),
							    array('Label', array('tag' => 'td', 'id' => 'mail_smtp_server-label')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr', 'id' => 'mail_smtp_server-wrapper'))),
			'attribs' => array('class' => 'text-input')
		));

		// Element: mail_smtp_port
		$this->addElement('Text', 'mail_smtp_port', array(
			'label' => 'SMTP Server Port',
			'description' => 'Default: 25. Also commonly on port 465 (SMTP over SSL) or port 587.',
			'required' => false,
			'value' => '25',
			'validators' => array(
				'Int'
			),
			'decorators' => array(
							    'ViewHelper',
							    'Errors',
								array('Description', array('tag' => 'small', 'class' => 'description', 'style' => 'display : block')),
							    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'id' => 'mail_smtp_port-element')),
							    array('Label', array('tag' => 'td', 'id' => 'mail_smtp_port-label')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr', 'id' => 'mail_smtp_port-wrapper'))),
			'attribs' => array('class' => 'text-input')
		));

		$authenticationOptions = array(
			"multiOptions" => array(
				1 => 'Yes',
				0 => 'No',
									
		));	
		$mail_smtp_authentication = new Zend_Form_Element_Radio('mail_smtp_authentication',$authenticationOptions);
		$mail_smtp_authentication->setRequired(false)
				  ->setLabel('SMTP Authentication?')
				  ->setDescription('Does your SMTP Server require authentication?')
				  ->setValue('0')
				  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array('Description', array('tag' => 'small', 'class' => 'description', 'style' => 'display : block')),
							    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'id' => 'mail_smtp_authentication-element')),
							    array('Label', array('tag' => 'td', 'id' => 'mail_smtp_authentication-label')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr', 'id' => 'mail_smtp_authentication-wrapper', 'class' => 'radio_inline'))))
				  ->setAttribs(array('id' => 'mail_smtp_authentication'));	   				  
		$this->addElement($mail_smtp_authentication);
		
		// Element: mail_smtp_username
		$this->addElement('Text', 'mail_smtp_username', array(
			'label' => 'SMTP Username',
			'decorators' => array(
							    'ViewHelper',
							    'Errors',
								array('Description', array('tag' => 'small', 'class' => 'description', 'style' => 'display : block')),
							    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'id' => 'mail_smtp_username-element')),
							    array('Label', array('tag' => 'td', 'id' => 'mail_smtp_username-label')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr', 'id' => 'mail_smtp_username-wrapper'))),
			'attribs' => array('class' => 'text-input')
		));

		// Element: mail_smtp_password
		$this->addElement('Password', 'mail_smtp_password', array(
			'label' => 'SMTP Password',
			'description' => 'Leave blank to use previous.',
			'decorators' => array(
									'ViewHelper',
									'Errors',
									array('Description', array('tag' => 'small', 'class' => 'description', 'style' => 'display : block')),
									array(array('data' => 'HtmlTag'), array('tag' => 'td', 'id' => 'mail_smtp_password-element')),
									array('Label', array('tag' => 'td', 'id' => 'mail_smtp_password-label')),
									array(array('row' => 'HtmlTag'), array('tag' => 'tr', 'id' => 'mail_smtp_password-wrapper'))),
			'attribs' => array('class' => 'text-input')
		));

		$sslOptions = array(
			"multiOptions" => array(
				'' => 'None',
				'tls' => 'TLS',
				'ssl' => 'SSL',				
		));	
		$mail_smtp_ssl = new Zend_Form_Element_Radio('mail_smtp_ssl',$sslOptions);
		$mail_smtp_ssl->setRequired(false)
				  ->setLabel('Use SSL or TLS?')
				  ->setValue('')
				  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array('Description', array('tag' => 'small', 'class' => 'description', 'style' => 'display : block')),
							    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'id' => 'mail_smtp_ssl-element')),
							    array('Label', array('tag' => 'td', 'id' => 'mail_smtp_ssl-label')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr', 'id' => 'mail_smtp_ssl-wrapper', 'class' => 'radio_inline'))))
				  ->setAttribs(array('id' => 'mail_smtp_ssl'));	   				  
		$this->addElement($mail_smtp_ssl);
		
		// Element: submit
		$this->addElement('Button', 'submit', array(
			'label' => 'Save Changes',
			'type' => 'submit',
			'ignore' => true,
			'decorators' => array(
							    'ViewHelper',
							    array(array('data' => 'HtmlTag'), array('tag' => 'span', 'id' => 'submit-element')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'span', 'id' => 'submit-wrapper'))),
			'attribs' => array('class' => 'button')
		));
		
		$this->addDisplayGroup(array('submit'),'btnsubmit',array(
            'decorators' => array(
                'FormElements',
                 array(array('data' => 'HtmlTag'), array('tag' => 'td','colspan' => 2)),
				 array(array('row' => 'HtmlTag'), array('tag' => 'td')),
				 array('HtmlTag', array('tag' => 'tr', 'id' => 'btn')),
            ),
        )); 
		
		$this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'table','class' => 'mail_settings')),
					'Form',
					));
  }

}