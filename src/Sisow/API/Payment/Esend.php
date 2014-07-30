<?php

namespace Sisow\API\Payment;

class Esend
{
    /** @var string */
    protected $firstname;

    /** @var string */
    protected $lastname;

    /** @var string */
    protected $email;

    /** @var string */
    protected $company;

    /** @var string */
    protected $address;

    /** @var string */
    protected $address2;

    /** @var string */
    protected $zipcode;

    /** @var string */
    protected $city;

    /** @var string */
    protected $country;

    /** @var string */
    protected $countryCode;

    /** @var string */
    protected $phone;

    /** @var string */
    protected $weight;

    /** @var string */
    protected $shippingCosts;

    /** @var string */
    protected $handleCosts;

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return $this
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return $this
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $company
     * @return $this
     */
    public function setCompany($company)
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return "{$this->address}\n{$this->address2}";
    }

    /**
     * @param string $address
     * @param string|null $address2
     * @return $this
     */
    public function setAddress($address, $address2 = null)
    {
        $this->address = $address;
        if ($address2) {
            $this->address2 = $address2;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param string $zipcode
     * @return $this
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode ISO-3166
     * @return $this
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param int|string $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     * @return $this
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingCosts()
    {
        return $this->shippingCosts;
    }

    /**
     * @param double $shippingCosts
     * @return $this
     */
    public function setShippingCosts($shippingCosts)
    {
        $this->shippingCosts = $shippingCosts;
        return $this;
    }

    /**
     * @return string
     */
    public function getHandleCosts()
    {
        return $this->handleCosts;
    }

    /**
     * @param double $handleCosts
     * @return $this
     */
    public function setHandleCosts($handleCosts)
    {
        $this->handleCosts = $handleCosts;
        return $this;
    }
}