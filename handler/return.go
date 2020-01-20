package handler

import (
	"net/http"

	"github.com/gin-gonic/gin"
)

type Return struct {
	Code    int         `json:"code"`
	Message string      `json:"message"`
	Data    interface{} `json:"data"`
}

// JSON 返回json格式
func (r Return) JSON(c *gin.Context) {
	c.AbortWithStatusJSON(r.Code, r)
}

// Success 返回成功信息
func Success(data interface{}, c *gin.Context) {
	Return{
		Code:    http.StatusOK,
		Message: "ok",
		Data:    data,
	}.JSON(c)
}

// Error 返回错误内容
func Error(code int, message string, c *gin.Context) {
	Return{
		Code:    code,
		Message: message,
		Data:    nil,
	}.JSON(c)
}
