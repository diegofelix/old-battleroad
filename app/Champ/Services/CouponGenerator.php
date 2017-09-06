<?php namespace Champ\Services;

class CouponGenerator
{
    /**
     * Key Generator.
     *
     * @var KeyGen
     */
    protected $keygen;

    public function __construct(KeyGen $keygen)
    {
        $this->keygen = $keygen;
    }

    /**
     * Generate a determined number of keys.
     *
     * @param int $qty
     *
     * @return array
     */
    public function make($qty)
    {
        $keys = [];

        while (count($keys) < $qty) {
            $key = $this->keygen->make();
            $keys[$key] = $key;
        }

        return $keys;
    }
}
