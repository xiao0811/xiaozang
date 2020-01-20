package model

import (
	"github.com/jinzhu/gorm"
)

// User Model
type User struct {
	gorm.Model
	Username   string `json:"username" form:"username"`
	Password   string `json:"password" form:"password"`
	Department uint8  `json:"department" form:"department"`
	Email      string `json:"email" form:"email"`
}

// TableName 重新设置表名
func (User) TableName() string {
	return "xiaosha"
}
