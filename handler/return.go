package handler

import (
	"github.com/gin-gonic/gin"
)

type Return struct {
	Code    int         `json:"code"`
	Message string      `json:"message"`
	Data    interface{} `json:"data"`
}

func (r Return) JSON(c *gin.Context) {
	c.AbortWithStatusJSON(r.Code, r)
}
