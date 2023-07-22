<?php

namespace App\Http;

class Response
{
  // Código do status Http
  private int $httpCode = 200;
  // Cabeçalho do Response
  private array $headers = [];
  // Tipod do conteudo 
  private string $contentType;
  // O conteúdo que está sendo retornado
  private mixed $cotent;

  public function __construct(int $httpCode, mixed $cotent, string $contentType = "text/html")
  {
    $this->httpCode = $httpCode;
    $this->cotent = $cotent;
    $this->setContentType($contentType);
  }

  public function addHeader(string $key, string $value)
  {
    $this->headers[$key] = $value;
  }
  // Adiciona o tipo de conteúdo no array de cabeçalho 
  public function setContentType(string $contentType)
  {
    $this->contentType = $contentType;
    $this->addHeader('Content-Type', $contentType);
  }

  // Envia cabeçalho do Response
  private function sendHeaders()
  {

    // Envia o status
    http_response_code($this->httpCode);

    //Envia os headers
    foreach ($this->headers as $key => $value) {
      header($key . ":" . $value);
    }
  }

  // Envia o conteúdo do Response
  public function sendResponse()
  {
    $this->sendHeaders();
    switch ($this->contentType) {
      case 'text/html':
        echo $this->cotent;
        exit;
    }
  }
}
