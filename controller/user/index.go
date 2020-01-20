package user

import (
	"fmt"
	"net/http"
	"strconv"

	"xiaosha/handler"
	"xiaosha/model"

	"github.com/gin-gonic/gin"
)

// Index api: /user GET
// 返回所有Users
func Index(c *gin.Context) {
	var users []model.User
	handler.GetEloquent().Find(&users)
	c.AbortWithStatusJSON(http.StatusOK, users)
}

// Create api: /user POST
func Create(c *gin.Context) {
	var user model.User
	db := handler.GetEloquent()
	if err := c.ShouldBind(&user); err != nil {
		handler.Error(http.StatusBadRequest, "数据填写有误", c)
	} else {
		if err := db.Create(&user).Error; err != nil {
			handler.Error(http.StatusInternalServerError, "服务器出错", c)
		} else {
			handler.Success(user, c)
		}
		fmt.Println(user)
	}
}

// GetUserByID 通过Id获取用户信息
func GetUserByID(c *gin.Context) {
	if userID, err := strconv.Atoi(c.Param("id")); err != nil {
		handler.Error(http.StatusBadRequest, "用户Id错误", c)
	} else {
		db := handler.GetEloquent()
		user := model.User{ID: uint(userID)}
		db.First(&user)
		handler.Success(user, c)
	}
}

// Update 更新用户信息
func Update(c *gin.Context) {
	if userID, err := strconv.Atoi(c.Param("id")); err != nil {
		handler.Error(http.StatusBadRequest, "用户Id错误", c)
	} else {
		db := handler.GetEloquent()
		user := model.User{ID: uint(userID)}
		if err := c.ShouldBind(&user); err != nil {
			handler.Error(http.StatusBadRequest, "更新数据有误", c)
		} else {
			db.Model(&model.User{}).Update(user)
			handler.Success(user, c)
		}
	}
}

// Delete 删除用户
func Delete(c *gin.Context) {
	if userID, err := strconv.Atoi(c.Param("id")); err != nil {
		handler.Error(http.StatusBadRequest, "用户Id错误", c)
	} else {
		db := handler.GetEloquent()
		db.Where("id = ?", userID).Delete(&model.User{})
		handler.Success(nil, c)
	}
}
