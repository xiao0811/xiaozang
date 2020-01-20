package handler

import (
	"log"
	"strconv"
	"sync"

	"xiaosha/config"

	"github.com/jinzhu/gorm"
	// mysql init
	_ "github.com/jinzhu/gorm/dialects/mysql"
)

var (
	once sync.Once
	db   *gorm.DB
)

// GetEloquent 连接MySQL 返回gorm
func GetEloquent() *gorm.DB {
	mysqlConfig := config.GetMysqlConfig()
	var err error
	// user:password@(localhost)/dbname?charset=utf8&parseTime=True&loc=Local

	once.Do(func() {
		db, err = gorm.Open("mysql", mysqlConfig.Username+":"+
			mysqlConfig.Password+"@("+
			mysqlConfig.Host+":"+
			strconv.Itoa(mysqlConfig.Port)+")/"+
			mysqlConfig.Database+"?charset=utf8&parseTime=True&loc=Local")
		if err != nil {
			log.Fatalln(err)
		}
	})
	return db
}
