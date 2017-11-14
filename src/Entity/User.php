<?php   // src/Entity/User.php

namespace MiW\Results\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(
 *     name                 = "users",
 *     uniqueConstraints    = {
 *          @ORM\UniqueConstraint(
 *              name="UNIQ_TOKEN", columns={ "token" }
 *          ),
 *      }
 *     )
 * @ORM\Entity
 */
class User implements \JsonSerializable
{
    /**
     * Id
     *
     * @var integer
     *
     * @ORM\Column(
     *     name     = "id",
     *     type     = "integer",
     *     length   = 11,
     *     nullable = false
     *     )
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    private $id;

    /**
     * Username
     *
     * @var string
     *
     * @ORM\Column(
     *     name     = "username",
     *     type     = "string",
     *     length   = 40,
     *     nullable = false,
     *     )
     */
    private $username;

    /**
     * Email
     *
     * @var string
     *
     * @ORM\Column(
     *     name     = "email",
     *     type     = "string",
     *     length   = 60,
     *     nullable = false,
     *     )
     */
    private $email;

    /**
     * Enabled
     *
     * @var boolean
     *
     * @ORM\Column(
     *     name     = "enabled",
     *     type     = "boolean",
     *     nullable = false
     *     )
     */
    private $enabled;

    /**
     * Password
     *
     * @var string
     *
     * @ORM\Column(
     *     name     = "password",
     *     type     = "string",
     *     length   = 60,
     *     nullable = false
     *     )
     */
    private $password;

    /**
     * User last_login
     *
     * @var \DateTime
     *
     * @ORM\Column(
     *     name     = "last_login",
     *     type     = "datetime",
     *     nullable = false
     *     )
     */
    private $last_login;


    /**
     * Token
     *
     * @var string
     *
     * @ORM\Column(
     *     name     = "token",
     *     type     = "string",
     *     length   = 40,
     *     nullable = false
     *     )
     */
    private $token;


    /**
     * User constructor.
     *
     * @param string    $username       username
     * @param string    $email          email
     * @param bool      $enabled        enabled
     * @param string    $password       password
     * @param \DateTime $last_login     last_login
     * @param string    $token          token
     */

    public function __construct(
        string $username = '',
        string $email = '',
        string $password = ''
    ) {
        $rand_token = str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789".uniqid());
        $this->id       = 0;
        $this->username = $username;
        $this->email    = $email;
        $this->setPassword($password);
        $this->enabled  = true;
        $this->token    = $rand_token;
        $this->last_login = new \DateTime('now');
    }

    /**
     * Get password hash
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set password
     *
     * @param string $password password
     *
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }

    /**
     * Verifies that the given hash matches the user password.
     *
     * @param string $password password
     *
     * @return boolean
     */
    public function validatePassword($password)
    {
        return password_verify($password, $this->password);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @return \DateTime
     */
    public function getLastLogin(): \DateTime
    {
        return $this->last_login;
    }

    /**
     * @param \DateTime $last_login
     */
    public function setLastLogin(\DateTime $last_login)
    {
        $this->last_login = $last_login;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token)
    {
        $rand_token = str_shuffle($token.uniqid());
        $this->token = $rand_token;
    }


    /**
     * Representation of User as string
     *
     * @return string
     */
    public function __toString(): string
    {
        return 'User: ' . $this->username . ' Email: ' . $this->getEmail();
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return array (
            'user' => array(
                        'id'                 => $this->id,
                        'username'           => utf8_encode($this->username),
                        'email'              => utf8_encode($this->email),
                        'enabled'            => $this->enabled,
                        'last_login'         => $this->last_login,
                        'token'              => $this->token
                    )
        );
    }
}
