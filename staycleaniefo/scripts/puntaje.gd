extends RichTextLabel

func _ready() -> void:
	var cont = Estados.contador
	text = str(cont)
	
	if cont == 9:
		modulate = Color.GOLD
	elif cont == -9:
		modulate = Color.REBECCA_PURPLE
	elif cont == 0:
		modulate = Color.DODGER_BLUE
	elif cont > 0:
		modulate = Color.LIME_GREEN if cont > 4 else Color.AQUAMARINE
	elif cont < 0:
		modulate = Color.RED if cont < -4 else Color.PALE_VIOLET_RED
