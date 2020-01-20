package model

import (
	"time"
)

// User Model
type User struct {
	ID         uint       `gorm:"primary_key" json:"id"`
	CreatedAt  time.Time  `json:"created_at"`
	UpdatedAt  time.Time  `json:"updated_at"`
	DeletedAt  *time.Time `sql:"index" json:"deleted_at"`
	Username   string     `json:"username" form:"username"`
	Password   string     `json:"password" form:"password"`
	Department uint8      `json:"department" form:"department"`
	Email      string     `json:"email" form:"email"`
}

// TableName 重新设置表名
func (User) TableName() string {
	return "xiaosha"
}
