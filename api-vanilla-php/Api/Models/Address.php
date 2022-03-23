<?php 

namespace Api\Models;

class Address
{

    private int $id;
    private string $publicPlace;
    private string $placeNumber;
    private string $zipCode;
    private string $complement;
    private string $district;
    private City $city;

    public function __construct()
    {
   
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getPublicPlace(): string
    {
        return $this->publicPlace;
    }

    public function setPublicPlace(string $publicPlace) : void
    {
        $this->publicPlace = $publicPlace;
    }

    public function getPlaceNumber(): string
    {
        return $this->placeNumber;
    }

    public function setPlaceNumber(string $placeNumber): void
    {
        $this->placeNumber = $placeNumber;
    }

    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    public function getComplement(): ?string
    {
        return $this->complement;
    }

    public function setComplement(string $complement): void
    {   
        if ($complement === null) {
            $complement = '';
        }
        $this->complement = $complement;
    }

    public function getDistrict(): string
    {
        return $this->district;
    }

    public function setDistrict(string $district): void
    {
        $this->district = $district;
    }

    public function getCity(): City
    {
        return $this->city;
    }

    public function setCity(City $city): void
    {
        $this->city = $city;
    }

}
