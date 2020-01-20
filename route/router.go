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
		user.POST("/", UserController.Create)
		user.PUT("/:id", UserController.Update)
		user.DELETE("/:id", UserController.Delete)
		user.GET("/:id", UserController.GetUserByID)
	}
	// app.GET("/", handler.CreateToken)

	return app
}
