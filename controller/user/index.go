package user

import (
	"fmt"
	"net/http"

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
		handler.Return{
			Code:    http.StatusBadRequest,
			Message: "数据填写有误",
			Data:    nil,
		}.JSON(c)
	} else {
		if err := db.Create(&user).Error; err != nil {
			handler.Return{
				Code:    http.StatusInternalServerError,
				Message: "服务器出错",
				Data:    nil,
			}.JSON(c)
		} else {
			handler.Return{
				Code:    http.StatusOK,
				Message: "OK",
				Data:    user,
			}.JSON(c)
		}
		fmt.Println(user)
	}
}
