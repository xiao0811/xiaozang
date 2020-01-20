package config

import (
	"io/ioutil"
	"log"

	"gopkg.in/yaml.v2"
)

// MysqlConfig mysql 配置项
type MysqlConfig struct {
	Username string `yaml:"USERNAME"`
	Password string `yaml:"PASSWORD"`
	Database string `yaml:"DATABASE"`
	Port     int    `yaml:"PORT"`
}

// GetMysqlConfig 读取配置文件
// 返回mysql 设置
func GetMysqlConfig() MysqlConfig {
	var conf MysqlConfig
	yamlFile, err := ioutil.ReadFile("mysql.yaml")
	if err != nil {
		log.Fatalln(err)
	}
	err = yaml.Unmarshal(yamlFile, &conf)
	if err != nil {
		log.Fatalln(err)
	}
	return conf
}
