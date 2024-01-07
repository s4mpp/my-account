<?php
namespace S4mpp\MyAccount\Traits;

use Illuminate\Support\Str;

trait TitleSluggable
{
	public function getTitle()
	{
		return $this->title;
	}

	public function getSlug(): string
	{
		return Str::slug($this->title);
	}
}