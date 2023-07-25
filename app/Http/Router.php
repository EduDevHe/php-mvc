<?php

namespace App\Http;

use \Closure;
use \Exception;

class Router
{

  private string $url;

  private string $prefix = '';

  private array $routes = [];

  private Request $request;

  public function __construct(string $url)
  {
    $this->request = new Request();
    $this->url = $url;
    $this->setPrefix();
  }

  private function setPrefix()
  {
    $parseUrl = parse_url($this->url);
    $this->prefix = $parseUrl['path'] ?? '';
  }

  public static function validateUrl($route): string
  {
    return '/^' . str_replace('/', '\/', $route) . '$/';
  }

  public static function validateParams(array $params): array
  {
    foreach ($params as $key => $value) {
      if ($value instanceof Closure) {
        $params["controller"] = $value;
        unset($params[$key]);
        continue;
      }
    }
    return $params;
  }

  private function getUri(): string
  {
    $uri = $this->request->getUri();

    $explodeUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];

    return end($explodeUri);
  }

  private function getRoute(): array
  {
    $uri = $this->getUri();
    $httpMethod = $this->request->getHttpMethod();

    foreach ($this->routes as $patternRoute => $methods) {
      if (preg_match($patternRoute, $uri)) {
        if (isset($methods[$httpMethod])) {
          return $methods[$httpMethod];
        }
        throw new Exception("Method Not Allowed", 405);
      }
    }
    throw new Exception("Error Processing Request", 1);
  }

  private function setRoute(string $method, string $route, array $params = [])
  {
    $this->routes[$route][$method] = $params;
  }

  public function get(string $route,  array $params = [])
  {
    $this->setRoute('GET', self::validateUrl($route), self::validateParams($params));
  }

  public function post(string $route,  array $params = [])
  {
    $this->setRoute('POST', self::validateUrl($route), self::validateParams($params));
  }
  public function delete(string $route,  array $params = [])
  {
    $this->setRoute('DELETE', self::validateUrl($route), self::validateParams($params));
  }

  public function put(string $route,  array $params = [])
  {
    $this->setRoute('PUT', self::validateUrl($route), self::validateParams($params));
  }

  public function run(): Response
  {
    try {
      $route = $this->getRoute();

      if (!isset($route['controller'])) {
        throw new Exception("Internal Server Error", 500);
      }
      return call_user_func_array($route['controller'], $args = []);
      throw new Exception("Pagia nao encontrada", 404);
    } catch (Exception $exception) {
      return new Response($exception->getCode(), $exception->getMessage());
    }
  }
}
