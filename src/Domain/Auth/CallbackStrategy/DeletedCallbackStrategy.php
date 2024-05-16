<?php

declare(strict_types=1);

namespace Travle\Domain\Auth\CallbackStrategy;

class DeletedCallbackStrategy extends BaseCallbackStrategy implements CallbackStrategy
{
    /** @param array<string, mixed> $data */
    public function execute(array $data): void
    {
        if (! isset($data['id'])) {
            return;
        }

        $data['id'] = 'user_29w83sxmDNGwOuEthce5gg56FcC';

        $this->repository->delete($data['id']);
    }
}
