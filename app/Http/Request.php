<?php

namespace App\Http;

class Request
{
  // Método Http da requísição
  private string $httpMethod;

  // URI da página
  private string $uri;

  // Parâmetros da URL ($_GET)
  private array $queryParams = [];

  // Variáveis recebidas pelo metodo POST ($_POST)
  private array $postVars = [];

  // Cabeçalho da requisição
  private array $headers = [];


  public function __construct()
  {
    $this->queryParams = $_GET ?? [];
    $this->postVars = $_POST ?? [];
    $this->headers = getallheaders();
    $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
    $this->uri = $_SERVER['REQUEST_URI'] ?? '';
  }
  // Retorna o o método Http
  public function getHttpMethod(): string
  {
    return $this->httpMethod;
  }
  // Retorna a Uri
  public function getUri(): string
  {
    return $this->uri;
  }
  // Retorna os Headers da requisição
  public function getHeaders(): array
  {
    return $this->headers;
  }
  // Retorna os QueryParams
  public function getQueryParams(): array
  {
    return $this->queryParams;
  }
  // Retorna as variáveis Post
  public function getPostVars(): array
  {
    return $this->postVars;
  }
}
