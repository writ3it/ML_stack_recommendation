<?php

namespace ITR\Base;


interface IResource{
    public function Serve(IResourceRequest $data): array;

    public function Process(IResourceRequest $data): array;
}