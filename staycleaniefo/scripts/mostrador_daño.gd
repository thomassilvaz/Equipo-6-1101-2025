extends Label

#al ser instanciado, el nodo activa su animacion
func _ready() -> void:
	$AnimationPlayer.play("aparicion")
	await $AnimationPlayer.animation_finished
	queue_free() #se borra posteriormente para evitar pérdida de memoria
