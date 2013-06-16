<?php
class WebUser extends User{
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'is_admin' => '管理员',
			'email' => '邮箱',
			'password' => '密码',
			'dateline' => '注册日期',
		);
	}
}
?>
