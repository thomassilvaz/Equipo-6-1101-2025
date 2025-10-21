extends Label

func _ready() -> void:
	$AnimationPlayer.play("aparicion")
	await $AnimationPlayer.animation_finished
	queue_free()
