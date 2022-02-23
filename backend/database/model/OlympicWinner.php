<?php


class OlympicWinner
{
    private string $name;
    private string $surname;
    private $year;
    private $typeOfOlympics;
    private string $place;
    private string $discipline;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear(mixed $year): void
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getTypeOfOlympics(): mixed
    {
        return $this->typeOfOlympics;
    }

    /**
     * @param mixed $typeOfOlympics
     */
    public function setTypeOfOlympics(mixed $typeOfOlympics): void
    {
        $this->typeOfOlympics = $typeOfOlympics;
    }

    /**
     * @return string
     */
    public function getPlace(): string
    {
        return $this->place;
    }

    /**
     * @param string $place
     */
    public function setPlace(string $place): void
    {
        $this->place = $place;
    }

    /**
     * @return string
     */
    public function getDiscipline(): string
    {
        return $this->discipline;
    }

    /**
     * @param string $discipline
     */
    public function setDiscipline(string $discipline): void
    {
        $this->discipline = $discipline;
    }

}
