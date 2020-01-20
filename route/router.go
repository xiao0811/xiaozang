package route

import (
	"xiaosha/handler"

	"github.com/gin-gonic/gin"
)

// GetRoute return all router
func GetRoute() *gin.Engine {
	app := gin.Default()

	app.GET("/", handler.CreateToken)

	return app
}
