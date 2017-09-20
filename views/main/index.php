<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <!--  引入extjs库-->
    <!--
    <link rel="stylesheet" type="text/css" href="/jrrc_web_dev/web/Extjs/theme-classic/resources/theme-classic-all.css" />
    <link rel="stylesheet" type="text/css" href="/Extjs/theme-neptune/resources/theme-neptune-all.css" />
    -->
    <link rel="stylesheet" type="text/css" href="/jrrc_web_dev/web/Extjs/theme-triton/resources/theme-triton-all.css" />
    <script type="text/javascript" src="/jrrc_web_dev/web/Extjs/ext.js"></script>
    <!-- <script type="text/javascript" src="/jrrc_web_dev/web/Extjs/ext-all-debug.js"></script> -->
    <script type="text/javascript" src="/jrrc_web_dev/web/Extjs/ext-all.js"></script> 
    <!-- 加载EXTjs中文配置文件 -->
    <script type="text/javascript" src="/jrrc_web_dev/web/Extjs/locale/locale-zh_CN-debug.js"></script>
    <title>欢迎使用国际业务信息查询系统</title>

</head>

<body>

</body>

</html>
<script>


    Ext.onReady(function() {

        // 退出系统按键
        var btn_logout = Ext.create('Ext.button.Button', {
            text: '退出',
            icon: '/icons/monitor/monitor_delete.png',
            width: 100,
            style: "float:right;margin:8px 5px 0 0",
            listeners: {
                click: {
                    fn: function() {

                        if (confirm("是否要退出") == true) {
                            logout();
                        }
                    }
                }
            }
        });
        // 处理退出登录事件
        function logout() {
            window.location.href = "/login/logout";
        }

        // 变更用户角色按键
        var btn_change_ruler = Ext.create('Ext.button.Button', {
            text: '变更角色',
            width: 100,
            icon: '/icons/user/user_go.png',
            style: "float:right;margin:8px 5px 0 0",
            listeners: {
                click: {
                    fn: function() {
                        // var b = Ext.create('Ext.button.Button', {
                        //     text: 'button'
                        // });
                        var win = Ext.create('public.static.myux.MyWindow').show();
                        // centerSide.items.push({b});
                        //console.log(table);

                    }
                }
            }
        });

        var label_title = Ext.create('Ext.form.Label', {
            text: "江门融和农商银行国际业务信息查询系统",
            style: "color:#5FA2DD;font:30px/50px heiti serif;margin:2px 3px 0 10px ",
            alignTarget: 'right'
        });

        var label_user = Ext.create('Ext.form.Label', {
            text: "欢迎你： <%=name %>]**[",
            style: "color:gray;margin:0 10px 0 0;font:12px/50px heiti serif ;float:right",
            alignTarget: 'right'
        });

        /*===================================
         *
         * 项部标题和用户信息
         *
         *
         * ==================================
         */
        var northSide = Ext.create('Ext.panel.Panel', {
            region: 'north',
            split: true,
            width: '100%',
            height: 50,

            items: [label_title, btn_logout, btn_change_ruler, label_user]

        });

        /*===================================
         *
         * 左则功能菜单树
         *
         *
         * ==================================
         */
        var leftSide = Ext.create('Ext.panel.Panel', {
            title: '系统功能',
            icon: '/icons/application/application_side_boxes.png',
            region: 'west',

            margin: '0 0 0 0',
            width: 200,
            split: true,
            collapsible: true, // make collapsible
            id: 'west-region-container',
            layout: 'fit',
            items: []
        });

        /*===================================
         *
         * 底部版权和版本信息
         *
         * ==================================
         */
        var southSide = {
            title: '<CENTER>融和农商银行国际业务部版权所有@2017年4月 VERSION 1.0</CENTER>',
            region: 'south',
            height: 35,
            padding: '0 0 0 0'

        };


        /*===================================
         *
         * 右则主功能tab窗口
         *
         * ==================================
         */


        function makeTipsPage(container, js_file) {
            console.log(container);
            Ext.Ajax.request({
                url: '/jrrc_web_php/public/static/js/subFunction/' + js_file + '.js',

                success: function(response, opts) {

                    var obj = eval(response.responseText);
                    var tab = {
                        title: "工作台",
                        closable: false,
                        id: 0,
                        items: [obj]
                    };

                    container.add(tab).show();
                },

                failure: function(response, opts) {
                    console.log('server-side failure with status code ' + response.status);
                }
            });
        }

        var tabPanel = Ext.create('Ext.tab.Panel', {

        });

        makeTipsPage(tabPanel, "tipsPage");

        var centerSide = {
            // title : '',
            collapsible: false,
            fixed: true,
            scrollable: true,
            region: 'center',
            padding: '0 0 0 0',
            margin: '0 0 0 0',
            items: [tabPanel]
        };

        /*===================================
         *
         * 项部标题和用户信息
         *
         * ==================================
         */
        Ext.define('mainWindow', {
            extend: 'Ext.panel.Panel',
            xtype: 'layout-border',
            requires: ['Ext.layout.container.Border'],
            layout: 'border',
            width: '99%',
            height: 600,
            margin: '10 10 10 10',
            bodyBorder: false,
            defaults: {
                bodyPadding: 0
            },
            items: [northSide, southSide, leftSide, centerSide],
            listeners: {
                render: {
                    fn: function() {
                        leftSide.add(createFunctionTree().expand());

                    }
                }
            }
        });

        Ext.create("mainWindow", {
            renderTo: Ext.getBody()
        });


        /*
         * 根据用户ID生成功能树
         * */
        function createFunctionTree() {
            var treeModel = Ext.create('Ext.data.TreeModel', {

                fields: ['id', 'name', 'url', 'pid', 'status'],

            });


            var store = Ext.create('Ext.data.TreeStore', {
                //autoLoad : true,

                model: treeModel,

                proxy: {
                    type: 'ajax',
                    url: '/rule/makeRuleTree',
                    reader: {
                        type: 'json',

                    }


                }
            });

            //  console.log(store);

            var tree = Ext.create('Ext.tree.Panel', {

                width: 200,
                height: 150,
                store: store,
                rootVisible: false, //隐藏根节点
                displayField: "name",
                folderSort: false,

                animate: true,
                listeners: {

                    itemclick: {
                        fn: function(tree, record, item, index, e, eOpts) {
                            //  console.log(record.data);
                            if (record.data.leaf == true) {
                                console.log(record.data.text);
                                var tab = Ext.getCmp(record.data.id);
                                if (!tab) {
                                    createTab(tabPanel, record);
                                } else {
                                    tabPanel.setActiveTab(tab);
                                }

                            }
                        }
                    }
                }
            });
            tree.expandAll();


            return tree;
        }


        function createTab(container, item) {
            console.log(item.data);
            Ext.Ajax.request({
                url: '/jrrc_web_php/public/static/js/subFunction/' + item.data.js_file + '.js',

                success: function(response, opts) {

                    var obj = eval(response.responseText);
                    //  var btn = Ext.create('Ext.button.Button', {text: 'button'});

                    var tab = {
                        title: item.data.rule_name,
                        closable: true,
                        id: item.data.id,
                        // html: response.responseText,
                        items: [obj]
                    };

                    container.add(tab).show();
                },

                failure: function(response, opts) {
                    console.log('server-side failure with status code ' + response.status);
                }
            });


        }


    });
</script>