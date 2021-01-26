<?php
/**
 * 微盘管理
 */
namespace WorkWeChat;

use WorkWeChat\Contracts\BasicWorkWeChat;
/**
 * 微盘管理
 * Class webdrive
 * @package WorkWeChat
 */
class Wedrive extends BasicWorkWeChat
{
    /**
     * 新建空间
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	          是否必须	说明
        userid	        是	    操作者userid
        space_name	    是	    空间标题
        auth_info	    否	    空间其他成员信息
        type	        否	    成员类型 1:个人 2:部门
        userid	        否	    成员userid,字符串
        departmentid	否	    部门departmentid, 32位整型范围是[0, 2^32)
        auth	        否	    成员权限 1:可下载 2:可编辑 4:可预览（仅专业版企业可设置）
     *
     * @example IDE跟踪查看案例
     *
        {
            "userid": "USERID",
            "space_name": "SPACE_NAME",
            "auth_info": [
                {
                    "type": 1,
                    "userid": "USERID",
                    "auth": 2
                },
                {
                    "type": 2,
                    "departmentid": "DEPARTMENTID",
                    "auth": 1
                }
            ]
        }
     *
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function space_create(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/wedrive/space_create?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        
        return $this->httpPostForJson($url, $data);
    }


    /**
     * 重命名空间
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	      是否必须	说明
        userid	    是	    操作者userid
        spaceid	    是	    空间spaceid
        space_name	是	    重命名后的空间名
     *
     * @example IDE跟踪查看案例
     *
        {
            "userid": "USERID",
            "spaceid": "SPACEID",
            "space_name": "SPACE_NAME"
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function space_rename(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/wedrive/space_rename?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 解散空间
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	      是否必须	说明
        userid	    是	    操作者userid
        spaceid	    是	    空间spaceid
     *
     * @example IDE跟踪查看案例
     *
        {
            "userid": "USERID",
            "spaceid": "SPACEID"
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function space_dismiss(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/wedrive/space_dismiss?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取空间信息
     * @param array $data
     * @uses IDE跟踪查看详细参数
     *
         参数	      是否必须	说明
         userid	        是	    操作者userid
         spaceid	    是	    空间spaceid
     *
     * @example IDE跟踪查看案例
     *
        {
            "userid": "USERID",
            "spaceid": "SPACEID"
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function space_info(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/wedrive/space_info?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }


    /**
     * 添加成员/部门 ,该接口用于对指定空间添加成员/部门，可一次性添加多个。
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	          是否必填	说明
        userid	        是	    操作者userid
        spaceid	        是	    空间spaceid
        auth_info	    是	    被添加的空间成员信息
        type	        是	    成员类型 1:个人 2:部门
        userid	        是	    成员userid,字符串 (type为1时填写)
        departmentid    是	    部门departmentid, 32位整型范围是[0, 2^32) (type为2时填写)
        auth	        是	    1:可下载 2:可编辑 4:可预览（仅专业版企业可设置）
     *
     * @example IDE跟踪查看案例
     *
        {
            "userid": "USERID",
            "spaceid": "SPACEID",
            "auth_info": [
                {
                    "type": 1,
                    "userid": "USERID1",
                    "auth": 2
                },
                {
                    "type": 2,
                    "departmentid": "DEPARTMENTID1",
                    "auth": 2
                }
            ]
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function space_acl_add(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/wedrive/space_acl_add?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }


    /**
     * 移除成员/部门，该接口用于对指定空间移除成员/部门，操作者需要有移除权限。
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	          是否必须	说明
        userid	        是	    操作者userid
        spaceid	        是	    空间spaceid
        auth_info	    是	    被移除的空间成员信息
        type	        是	    成员类型 1:个人 2:部门
        userid	        是	    成员userid,字符串 (type为1时填写)
        departmentid	是	    部门departmentid, 32位整型范围是[0, 2^32) (type为2时填写)
     *
     * @example IDE跟踪查看案例
     *
        {
            "userid": "USERID",
            "spaceid": "SPACEID",
            "auth_info": [
                {
                    "type": 1,
                    "userid": "USERID1",
                    "auth": 2
                },
                {
                    "type": 2,
                    "departmentid": "DEPARTMENTID1",
                    "auth": 2
                }
            ]
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function space_acl_del(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/wedrive/space_acl_del?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 权限管理
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数                              是否必须	    说明
        userid	                            是	    操作者userid
        spaceid	                            是	    空间spaceid
        enable_watermark	                否	    （本字段仅专业版企业可设置）启用水印。false:关 true:开 ;如果不填充此字段为保持原有状态
        add_member_only_admin	            否	    仅管理员可增减空间成员和修改文件分享设置。false:关 true:开 ；如果不填充此字段为保持原有状态
        enable_share_url	                否	    启用成员邀请链接。false:关 true:开 ；如果不填充此字段为保持原有状态
        share_url_no_approve	            否	    通过链接加入空间无需审批。false:关； true:开； 如果不填充此字段为保持原有状态
        share_url_no_approve_default_auth	否	    邀请链接默认权限。1:仅浏览（可下载）2:可编辑 4:可预览（仅专业版企业可设置）；如果不填充此字段为保持原有状态
     *
     * @example IDE跟踪查看案例
     *
        {
            "userid": "USERID",
            "spaceid": "SPACEID",
            "enable_watermark": "ENABLE_WATERMARK",
            "add_member_only_admin": "ADD_MEMBER_ONLY_ADMIN",
            "enable_share_url": "ENABLE_SHARE_URL",
            "share_url_no_approve": "SHARE_URL_NO_APPROVE",
            "share_url_no_approve_default_auth": "SHARE_URL_NO_APPROVE_DEFAULT_AUTH"
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function space_setting(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/wedrive/space_setting?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取邀请链接
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	      是否必须	说明
        userid	    是	    操作者userid
        spaceid	    是	    空间spaceid
     *
     * @example IDE跟踪查看案例
     *
        {
            "userid": "USERID",
            "spaceid": "SPACEID"
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function space_share(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/wedrive/space_share?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取文件列表
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	        类型	      是否必须	说明
        userid	    string	    是	    操作者userid
        spaceid	    string	    是	    空间spaceid
        fatherid	string	    是	    当前目录的fileid,根目录时为空间spaceid
        sort_type	uint32	    是	    列表排序方式 1:名字升序；2:名字降序；3:大小升序；4:大小降序；5:修改时间升序；6:修改时间降序
        start	    uint32	    是	    首次填0, 后续填上一次请求返回的next_start
        limit	    uint32	    是	    分批拉取最大文件数, 不超过1000
     *
     * @example IDE跟踪查看案例
     *
        {
            "userid": "USERID",
            "spaceid": "SPACEID",
            "fatherid": "FATHERID",
            "sort_type": SORT_TYPE,
            "start": START,
            "limit": LIMIT
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function file_list(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/wedrive/file_list?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 上传文件
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	              是否必须	说明
        userid	            是	    操作者userid
        spaceid	            是	    空间spaceid
        fatherid	        是	    父目录fileid, 在根目录时为空间spaceid
        file_name	        是	    文件名字
        file_base64_content	是	    文件内容base64（注意：只需要填入文件内容的Base64，不需要添加任何如：”data:application/x-javascript;base64” 的数据类型描述信息）
     *
     * @example IDE跟踪查看案例
     *
        {
            "userid": "USERID",
            "spaceid": "SPACEID",
            "fatherid": "FATHERID",
            "file_name": "FILE_NAME",
            "file_base64_content": "FILE_BASE64_CONTENT"
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function file_upload(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/wedrive/file_upload?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 下载文件
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	      是否必须	说明
        userid	    是	    操作者userid
        fileid	    是	    文件fileid（只支持下载普通文件，不支持下载文件夹）
     *
     * @example IDE跟踪查看案例
     *
        {
            "userid": "USERID",
            "fileid": "FILEID"
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function file_download(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/wedrive/file_download?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 新建文件/微文档
     * @param array $data
     * @uses IDE跟踪查看详细参数
     *
        参数	        类型	      是否必须	    说明
        userid	    string	    是	    操作者userid
        spaceid	    string	    是	    空间spaceid
        fatherid	string	    是	    父目录fileid, 在根目录时为空间spaceid
        file_type	uint32	    是	    文件类型, 1:文件夹 3:微文档(文档) 4:微文档(表格)
        file_name	string	    是	    文件名字
     *
     * @example IDE跟踪查看案例
     *
        {
            "userid": "USERID",
            "spaceid": "SPACEID",
            "fatherid": "FATHERID",
            "file_type": "FILE_TYPE",
            "file_name": "FILE_NAME"
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function file_create(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/wedrive/file_create?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 重命名文件
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	        类型	     是否必须	    说明
        userid	    string	    是	    操作者userid
        fileid	    string	    是	    文件fileid
        new_name	string	    是	    重命名后的文件名
     *
     * @example IDE跟踪查看案例
     *
    {
    "userid": "USERID",
    "fileid": "FILEID",
    "new_name": "NEW_NAME"
    }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function file_rename(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/wedrive/file_rename?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 移动文件
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	        类型	      是否必须	说明
        userid	    string	    是	    操作者userid
        fatherid	string	    是	    当前目录的fileid,根目录时为空间spaceid
        replace	    bool	    否	    如果移动到的目标目录与需要移动的文件重名时，是否覆盖。true:重名文件覆盖 false:重名文件进行冲突重命名处理（移动后文件名格式如xxx(1).txt xxx(1).doc等）
        fileid	    string	    是	    文件fileid
     *
     * @example IDE跟踪查看案例
     *
        {
            "userid": "USERID",
            "fatherid": "FATHERID",
            "replace": true,
            "fileid": ["FILEID1", "FILEID2"]
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function file_move(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/wedrive/file_move?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 删除文件
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	      是否必须	说明
        userid	    是	    操作者userid
        fileid	    是	    文件fileid
     *
     * @example IDE跟踪查看案例
     *
        {
            "userid": "USERID",
            "fileid": ["FILEID1", "FILEID2"]
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function file_delete(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/wedrive/file_delete?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 文件信息
     * @param array $data
     * @uses IDE跟踪查看详细参数
     *
        参数	        类型	      是否必须	说明
        userid	    string	    是	    操作者userid
        fileid	    string	    是	    文件fileid
     *
     * @example IDE跟踪查看案例
     *
        {
            "userid": "USERID",
            "fileid": "FILEID"
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function file_info(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/wedrive/file_info?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 新增指定人
     * @param array $data
     * @uses IDE跟踪查看详细参数
     *
        参数	        是否必须	    说明
        userid	      是	    操作者userid
        fileid	      是	    文件fileid
        auth_info	  是	    添加成员的信息
        type	      是	    成员类型 1:个人 2:部门
        userid	      是	    成员userid,字符串 (type为1时填写)
        auth	      是	    新增成员的权限信息，
                                普通文档：1:仅浏览（可下载) 4:仅预览（仅专业版企业可设置）；如果不填充此字段为保持原有状态，
                                微 文 档： 1:仅浏览（可下载）2:可编辑；如果不填充此字段为保持原有状态
        departmentid  是	    部门departmentid, 32位整型范围是[0, 2^32) (type为2时填写)
     *
     * @example IDE跟踪查看案例
     *
        {
            "userid": "USERID",
            "fileid": "FILEID",
            "auth_info": [
                {
                    "type": 1,
                    "userid": "USERID1",
                    "auth": 2
                },
                {
                    "type": 2,
                    "departmentid": "DEPARTMENT_ID1",
                    "auth": 1
                }
            ]
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function file_acl_add(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/wedrive/file_acl_add?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 删除指定人
     * @param array $data
     * @uses IDE跟踪查看详细参数
     *
        参数	          是否必须	说明
        userid	        是	    操作者userid
        fileid	        是	    文件fileid
        auth_info	    是	    被移除的成员信息
        type	        是	    成员类型 1:个人 2:部门
        userid	        是	    成员userid,字符串 (type为1时填写)
        departmentid	是	    部门departmentid, 32位整型范围是[0, 2^32) (type为2时填写)
     *
     * @example IDE跟踪查看案例
     *
        {
            "userid": "USERID",
            "fileid": "FILEID",
            "auth_info": [{
                "type": 1,
                "userid": "USERID1"
            }, {
                "type": 2,
                "departmentid": "DEPARTMENT_ID1"
            }]
        }
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function file_acl_del(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/wedrive/file_acl_del?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 分享设置
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	      是否必须	说明
        userid	    是	    操作者userid
        fileid	    是	    文件fileid
        auth_scope	是	    权限范围：1:指定人 2:企业内 3:企业外
        auth	    否	    权限信息
                            普通文档： 1:仅浏览（可下载) 4:仅预览（仅专业版企业可设置）；如果不填充此字段为保持原有状态
                            微文档： 1:仅浏览（可下载） 2:可编辑；如果不填充此字段为保持原有状态
     *
     * @example IDE跟踪查看案例
     *
        {
            "userid": "USERID",
            "fileid": "FILDID",
            "auth_scope": "AUTH_SCOPE",
            "auth": 1
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function file_setting(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/wedrive/file_setting?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }

    /**
     * 获取分享链接
     * @param array $data 请求参数
     * @uses IDE跟踪查看详细参数
     *
        参数	         类型	是否必须	 说明
        userid	    string	  是	 操作者userid
        fileid	    string	  是	 文件fileid
     *
     * @example IDE跟踪查看案例
     *
        {
            "userid": "USERID",
            "fileid": "FILEID"
        }
     *
     * @return array
     * @throws Exceptions\InvalidResponseException
     */
    public function file_share(array $data):array
    {
        $url = "https://qyapi.weixin.qq.com/cgi-bin/wedrive/file_share?access_token=ACCESS_TOKEN";
        $this->registerApi($url, __FUNCTION__, func_get_args());
        return $this->httpPostForJson($url, $data);
    }


}
