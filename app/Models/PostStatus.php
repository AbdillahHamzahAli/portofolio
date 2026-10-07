<?php

namespace App\Models;

enum PostStatus: string
{
    case Draft = 'draft';
    case Published = 'published';
}
