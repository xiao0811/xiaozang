package route

import (
	UserController "xiaosha/controller/user"

	"github.com/gin-gonic/gin"
)

// GetRoute return all router
func GetRoute() *gin.Engine {
	app := gin.Default()

	user := app.Group("/user")
	{
		user.GET("/", UserController.Index)
	}
	// app.GET("/", handler.CreateToken)

	return app
}
