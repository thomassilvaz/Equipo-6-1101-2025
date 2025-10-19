shader_type canvas_item;

uniform sampler2D texture2;
uniform sampler2D colorTexture;
uniform vec2 scroll1 = vec2(0.01, 0.01);
uniform vec2 scroll2 = vec2(0.02, 0.02);
uniform float fade_alpha = 1.0;

void fragment() {
	COLOR = texture(TEXTURE, UV);
    COLOR.a *= fade_alpha;
	
	float textureColor1 = texture(TEXTURE, UV + scroll1 * TIME).r;
	float textureColor2 = texture(TEXTURE, UV + scroll2 * TIME).r;
	float energia = textureColor1 * textureColor2;
	COLOR = vec4(energia, energia, energia, 0.5);
}
