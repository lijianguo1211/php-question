### javaScript 中 this 的指向

1. 事件调用环境，`this`就是指向当前的调用者

2. 全局环境 `console.log(this)` 指向的就是浏览器的`windows`对象

3. 在`node`环境中指向就是导出的 `module.exports`

4. 在函数内部：

```javascript
function move()
{
    console.log(this);
}

move();
```

* 非严格模式下，直接调用函数，函数内部`this`指向的是`windos`对象

* 严格模式，直接调用函数，函数内部`this`指向的是`undefined`

```javascript
var obj = {
        a:10,
        b: {
            fn: function () {
                console.log(this);
                console.log(this.c);
            },
            c: 20
        },
        fn: function () {
            console.log(this);
            console.log(this.a);
            console.log(this.b);
        }
    };

    obj.b.fn();
    obj.fn();
```

4.1 `this`最终指向的是调用它的对象

4.2 函数被多层对象所包含，如果函数被最外层对象调用，`this`指向的也只是它上一级的对象

4.3 构造函数中的`this`指向的是实例对象

4.3.1. 调用函数

4.3.2. 自动创建一个对象

4.3.3. 把创建出来的对象和`this`绑定

4.3.4. 如果构造函数没有返回值，返回的就是`this`对象

```javascript
function fn () {
        this.num = 10;
        console.log(this);
    }

    var obj = new fn();
```

4.4 如果否早函数中有`return`,如果`return`的值是对象，`this`指向的就是返回的对象，如果返回的值不是对象，则`this`还是保持原来的规则，在这里`null`
值比较特殊。

```javascript
    function fn () {
        this.num = 10;
        return null;
    }
    let obj = new fn();
    console.log(obj.num);//10
```

```javascript
    function fn () {
        this.num = 10;
        return '';
    }
    let obj = new fn();
    console.log(obj.num);//10
```

```javascript
function fn () {
        this.num = 10;
        return null;
    }
    let obj = new fn();
    console.log(obj.num);//10
```

```javascript
    function fn () {
        this.num = 10;
        return 1;
    }
    let obj = new fn();
    console.log(obj.num);//10
```

```javascript
function fn () {
        this.num = 10;
        return [];
    }
    let obj = new fn();
    console.log(obj.num);//undefined
```

```javascript
    function fn () {
        this.num = 10;
        return {};
    }
    let obj = new fn();
    console.log(obj.num);//undefined
```

```javascript
    function fn () {
        this.num = 10;
        return function () {
            
        };
    }
    let obj = new fn();
    console.log(obj.num);//undefined
```

