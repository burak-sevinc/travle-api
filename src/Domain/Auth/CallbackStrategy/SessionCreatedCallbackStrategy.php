<?php

declare(strict_types=1);

namespace Travle\Domain\Auth\CallbackStrategy;

use Throwable;
use Travle\Domain\Auth\Exception\CallbackFailed;
use Travle\Shared\Exception\UserNotFound;

class SessionCreatedCallbackStrategy extends BaseCallbackStrategy implements CallbackStrategy
{
    /** @param array<string, mixed> $data */
    public function execute(array $data): void
    {
        $email = $data['email_addresses'][0]['email_address'];

        if (! isset($email)) {
            return;
        }

        $data['email'] = $email;
        try {
            $user = $this->repository->getUserByUuid($data['id']);

            if ($user) {
                $this->repository->update($data);

                return;
            }
        } catch (UserNotFound) {
            $this->repository->create($data);

            return;
        } catch (Throwable $e) {
            throw CallbackFailed::create('Failed to execute callback', ['error' => $e->getMessage()]);
        }
    }
}
