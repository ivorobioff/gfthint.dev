<?php
namespace GftHint\Core\User\Entity;
use Developer\Cast\Cast;
use GftHint\Core\Gift\Entity\Gift;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class User 
{
	private $id;
	private $email;
	private $passwordHash;
	private $firstName;
	private $lastName;
	private $dateOfBirth;
	private $imageUrl;

	/**
	 * @var Gift[]
	 */
	private $gifts = [];

	/**
	 * @var User[]
	 */
	private $friends = [];

	public function setId($id)
	{
		$this->id = Cast::int($id);
	}

	public function getId()
	{
		return $this->id;
	}

	public function setEmail($email)
	{
		$this->email = Cast::string($email);
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setFirstName($firstName)
	{
		$this->firstName = Cast::string($firstName);
	}

	public function getFirstName()
	{
		return $this->firstName;
	}

	public function setLastName($lastName)
	{
		$this->lastName = Cast::string($lastName);
	}

	public function getLastName()
	{
		return $this->lastName;
	}

	public function getFullName()
	{
		return $this->firstName.' '.$this->lastName;
	}

	public function setDateOfBirth(\DateTime $dateTime = null)
	{
		$this->dateOfBirth = $dateTime;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getDateOfBirth()
	{
		return $this->dateOfBirth;
	}

	public function setImageUrl($url)
	{
		$this->imageUrl = Cast::string($url);
	}

	public function getImageUrl()
	{
		return $this->imageUrl;
	}

	public function setPasswordHash($hash)
	{
		$this->passwordHash = Cast::string($hash);
	}

	public function getPasswordHash()
	{
		return $this->passwordHash;
	}

	public function setGifts($gifts)
	{
		$this->gifts = $gifts;
	}

	/**
	 * @return Gift[]
	 */
	public function getGifts()
	{
		return $this->gifts;
	}

	public function setFriends($friends)
	{
		$this->friends = $friends;
	}

	/**
	 * @return User[]
	 */
	public function getFriends()
	{
		return $this->friends;
	}
} 