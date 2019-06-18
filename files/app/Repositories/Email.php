<?php namespace App\Repositories;

use Mail;
use Swift_Mailer;

use App\User;

class Email
{
	public $fromEmail;
	public $fromName;
	public $toEmail;
	public $toName;
	public $subject;

	public function sendRegEmail($to, $subject, $view, $data)
    {
    	// Backup your default mailer
		$backup = Mail::getSwiftMailer();

		// Setup your newMail mailer
		$transport = \Swift_SmtpTransport::newInstance(env('MAIL_HOST'), env('MAIL_PORT'));
		$transport->setUsername(env('MAIL_REG_USERNAME'));
		$transport->setPassword(env('MAIL_PASSWORD'));
		// Any other mailer configuration stuff needed...

		$newMail = new Swift_Mailer($transport);

		// Set the mailer as newMail
		Mail::setSwiftMailer($newMail);

		$this->fromEmail = env('MAIL_REG_USERNAME');
		$this->fromName = env('MAIL_REG_NAME');
		$this->toEmail = $to['email'];
		$this->toName = $to['name'];
		$this->subject = $subject;

        Mail::send($view, ['data' => $data], function ($m) {
            $m->from($this->fromEmail, $this->fromName);

            $m->to($this->toEmail, $this->toName)->subject($this->subject);
        });

        // Restore your original mailer
		Mail::setSwiftMailer($backup);
    }

    public function sendContactEmail($to, $subject, $view, $data)
    {
    	// Backup your default mailer
		$backup = Mail::getSwiftMailer();

		// Setup your newMail mailer
		$transport = \Swift_SmtpTransport::newInstance(env('MAIL_HOST'), env('MAIL_PORT'));
		$transport->setUsername(env('MAIL_CONTACT_USERNAME'));
		$transport->setPassword(env('MAIL_PASSWORD'));
		// Any other mailer configuration stuff needed...

		$newMail = new Swift_Mailer($transport);

		// Set the mailer as newMail
		Mail::setSwiftMailer($newMail);

		$this->fromEmail = env('MAIL_CONTACT_USERNAME');
		$this->fromName = env('MAIL_CONTACT_NAME');
		$this->toEmail = $to['email'];
		$this->toName = $to['name'];
		$this->subject = $subject;

        Mail::send($view, ['data' => $data], function ($m) {
            $m->from($this->fromEmail, $this->fromName);

            $m->to($this->toEmail, $this->toName)->subject($this->subject);
        });

        // Restore your original mailer
		Mail::setSwiftMailer($backup);
    }

    public function sendAccEmail($to, $subject, $view, $data)
    {
    	// Backup your default mailer
		$backup = Mail::getSwiftMailer();

		// Setup your newMail mailer
		$transport = \Swift_SmtpTransport::newInstance(env('MAIL_HOST'), env('MAIL_PORT'));
		$transport->setUsername(env('MAIL_ACC_USERNAME'));
		$transport->setPassword(env('MAIL_PASSWORD'));
		// Any other mailer configuration stuff needed...

		$newMail = new Swift_Mailer($transport);

		// Set the mailer as newMail
		Mail::setSwiftMailer($newMail);

		$this->fromEmail = env('MAIL_ACC_USERNAME');
		$this->fromName = env('MAIL_ACC_NAME');
		$this->toEmail = $to['email'];
		$this->toName = $to['name'];
		$this->subject = $subject;

        Mail::send($view, ['data' => $data], function ($m) {
            $m->from($this->fromEmail, $this->fromName);

            $m->to($this->toEmail, $this->toName)->subject($this->subject);
        });

        // Restore your original mailer
		Mail::setSwiftMailer($backup);
    }

    public function sendOrderEmail($to, $subject, $view, $data)
    {
    	// Backup your default mailer
		$backup = Mail::getSwiftMailer();

		// Setup your newMail mailer
		$transport = \Swift_SmtpTransport::newInstance(env('MAIL_HOST'), env('MAIL_PORT'));
		$transport->setUsername(env('MAIL_ORDER_USERNAME'));
		$transport->setPassword(env('MAIL_PASSWORD'));
		// Any other mailer configuration stuff needed...

		$newMail = new Swift_Mailer($transport);

		// Set the mailer as newMail
		Mail::setSwiftMailer($newMail);

		$this->fromEmail = env('MAIL_ORDER_USERNAME');
		$this->fromName = env('MAIL_ORDER_NAME');
		$this->toEmail = $to['email'];
		$this->toName = $to['name'];
		$this->subject = $subject;

        Mail::send($view, ['data' => $data], function ($m) {
            $m->from($this->fromEmail, $this->fromName);

            $m->to($this->toEmail, $this->toName)->subject($this->subject);
        });

        // Restore your original mailer
		Mail::setSwiftMailer($backup);
    }

    
}