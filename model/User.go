package model

import (
	"github.com/jinzhu/gorm"
)

// User Model
type User struct {
	gorm.Model
	Username   string `json:"username"`
	Password   string `json:"password"`
	Department uint8  `json:"department"`
	Email      string `json:"email"`
}

// TableName 重新设置表名
func (User) TableName() string {
	return "xiaosha"
}
