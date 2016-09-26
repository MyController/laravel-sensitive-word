## Sensitive Word Service For Laravel5 and Lumen5

敏感词验证服务

### 安装

  ```shell
  composer require mycontroller/laravel-sensitive-word
  ```

## 配置

在 `/config/app.php` 文件中找到 `providers` 键，

  ```shell
  'providers' => [
    ...
    MyController\SensitiveWord\Providers\SensitiveWordServiceProvider::class,
    ...
  ];
  ```

在 `/config/app.php` 文件中找到 `aliases` 键，

  ```shell
  'aliases' => [
    ...
    'SensitiveWord' => MyController\SensitiveWord\Facades\SensitiveWordFacade::class,
    ...
  ];
  ```

## 使用

  ```shell
  $result = SensitiveWord::getFirstSensitiveWordInContent('待验证的含有敏感词的字符串');
  dd($result);
  ```
  
## 关于验证规则

  ```shell
  提供了表单验证规则 has_sensitive_word
  ```
  
## 关于自定义敏感词库

    这部分还没有做
  
## License

MIT
