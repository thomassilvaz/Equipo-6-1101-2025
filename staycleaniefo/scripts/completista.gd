extends Control

func _ready() -> void:
	if Estados.contador == 9:
		show()
	else:
		hide()
