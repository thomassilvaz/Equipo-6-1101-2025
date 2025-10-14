extends CollisionShape2D

@export var condicion_a_detectar: String
var condicion_hecha: bool

func _process(_delta: float) -> void:
	if Estados.get(condicion_a_detectar) != null:
		condicion_hecha = Estados.get(condicion_a_detectar)
	if !condicion_hecha:
		set_deferred("disabled", true)
	else:
		set_deferred("disabled", false)
