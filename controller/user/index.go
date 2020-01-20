package user

import (
	"net/http"
	"xiaosha/handler"
	"xiaosha/model"

	"github.com/gin-gonic/gin"
)

// Index api:/users
func Index(c *gin.Context) {
	var users []model.User
	handler.GetEloquent().Find(&users)
	c.AbortWithStatusJSON(http.StatusOK, users)
}
