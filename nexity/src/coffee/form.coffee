$ ->
  
  bg = $("#cover")
  pin = $("#cover .pin img")
  
  xMouseNew = 0
  xDeltaNew = 0
  
  $(window).on "mousemove", (evt) -> 
  
    if evt.clientX != xMouseNew
      
      larg = $(window).width()
      if larg > 768
        xMouseNew = evt.clientX
        xDeltaNew = (xMouseNew * 2 / larg - 1)
      else
        xMouseNew = 0
        xDeltaNew = 0
        
      posBG = ((xDeltaNew + 1) * 10 + 50) + "% 0%, center"
      posPin = xDeltaNew * 5 + "px"
      bg.css("background-position", posBG)
      pin.css("transform", "translateX(" + posPin + ")")
