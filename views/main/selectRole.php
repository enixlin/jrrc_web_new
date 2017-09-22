<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!--  引入extjs库-->
    <link rel="stylesheet" type="text/css" href="./../../../jrrc_web_new/web/Extjs/theme-triton/resources/theme-triton-all.css" />
    <script type="text/javascript" src="./../../../jrrc_web_new/web/Extjs/ext.js"></script>
    <!-- <script type="text/javascript" src="/jrrc_web_dev/web/Extjs/ext-all-debug.js"></script> -->
    <script type="text/javascript" src="./../../../jrrc_web_new/web/Extjs/ext-all.js"></script> 
    <!-- 加载EXTjs中文配置文件 -->
    <script type="text/javascript" src="./../../../jrrc_web_new/web/Extjs/locale/locale-zh_CN-debug.js"></script>
    <title>欢迎使用国际业务信息查询系统</title>


</head>
<body>
    
</body>
</html>


<script>
Ext.onReady(function(){

    Ext.Ajax.request({
        url: './../../../jrrc_web_new/web/user/get-user-role',
        success: function(response, opts) {
            var roles = eval("(" + response.responseText + ")"); //转换为json对象
            var role=[];
            //console.log(roles);
                for(var  item in roles){
                    //console.log(item);
                    role.push({
                        boxLabel  :roles[item].role_name,
                        name      : 'role',
                        inputValue: roles[item].id,
                       // id        :roles[item].id,
                    });
                }
            var roleWindow=Ext.create('Ext.window.Window',{
                        x:400,
                        y:300,
                        width:300,
                        height:330,
                        id:'roleWindow',
                        margin:'5 5 5 5',
                        title:'请选择用户角色',
                        items:[
                            {
                                xtype: 'fieldset',
                                id: 'role',
                                title: '角色选择',
                                autoHeight: true,
                                defaultType: 'radio',  //设置fieldset内的默认元素为radio
                                layout: 'vbox',
                                 items: role
                            },
                            {
                                xtype: 'hiddenfield',
                                name:"_csrf-backend", 
                                id:"_csrf",
                                value:"<?php echo Yii::$app->request->csrfToken ?>"
                            }, 
                            {
                                xtype:'button',
                                text:"选择",
                                width:100,
                                margin:"5 5 5 150",
                                listeners:{
                                    click:function(){
                                        var Roles=Ext.getCmp("role").items.items;
                                        var selectRoleId;
                                        var selectRoleName;
                                        for(var i=0,len=Roles.length;i<len;i++){
                                          if(Roles[i].checked==true){
                                            selectRoleId=Roles[i].inputValue;
                                            selectRoleName=Roles[i].boxLabel;

                                          }
                                        }
                                       var _csrf_backend=Ext.getCmp('_csrf').value;

                                       Ext.Ajax.request({
                                            url: './../../../jrrc_web_new/web/user/use-role',
                                            method: 'post',
                                            params: {
                                                'roleId': selectRoleId,
                                                "role_name":selectRoleName,
                                                '_csrf-backend':_csrf_backend
                                            },
                                            success: function(response, opts) {
                                                if (response.responseText!="") {
                                                    window.location.href = "./../../../jrrc_web_new/web/main";
                                                } 
                                            },
                                            failure: function(response, opts) {
                                                alert("选择角色有误，出错信息：" + response.responseText);
                                            }
                                       });
                                    }
                                }
                            }
                        ]
                }).show();
        },

        failure: function(response, opts) {
            console.log('server-side failure with status code ' + response.status);
        }
    });
});

</script>
