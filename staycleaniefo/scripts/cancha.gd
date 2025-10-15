extends CollisionShape2D

func _ready():
	if Estados.sustancia1:
		set_deferred("disabled", false)
	else:
		set_deferred("disabled", true)
