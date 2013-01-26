# ZF2 REST tunneling module

This module is a simple REST module based on tunneling method.

Please consider to use the default CRUD module provided by ZF2 instead this
one.

This module goal is to show how is simple to realize RESTful modules.

## Use this module

Download the default ZF2 Skeleton Application and place this module into the
`module` folder.

```shell
git clone https://github.com/zendframework/ZendSkeletonApplication.git my-app
cd my-app

git submodule add \
    https://github.com/wdalmut/ZF2-Tunneling-Restful-Module-Skeleton.git \
    module/Tunneling

git submodule init
git submodule update
```

Now you can try this module using example urls:

 * /tunnel/menu/get?id=1
 * /tunnel/menu/add?x=pizza&y=4

That's all it is.

