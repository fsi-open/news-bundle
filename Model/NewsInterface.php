<?php

namespace FSi\Bundle\NewsBundle\Model;

interface NewsInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param string $content
     */
    public function setContent($content);

    /**
     * @return string
     */
    public function getContent();

    /**
     * @param \DateTime $data
     */
    public function setDate(\DateTime $data);

    /**
     * @return \DateTime
     */
    public function getDate();

    /**
     * @param string $introduction
     */
    public function setIntroduction($introduction);

    /**
     * @return string
     */
    public function getIntroduction();

    /**
     * @param string $title
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getTitle();
}