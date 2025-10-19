extends CollisionShape2D

func _ready():
	if !Estados.sustancia1 or Estados.charla_con_valeria == true:
		set_deferred("disabled", true)
	else:
		set_deferred("disabled", false)
