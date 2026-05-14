<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfilUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_profile_photo_and_password(): void
    {
        Storage::fake('public');

        /** @var User $user */
        $user = User::factory()->create([
            'password' => Hash::make('passwordlama123'),
        ]);

        $this->actingAs($user)
            ->put(route('profil.update'), [
                'name' => 'Nama Baru',
                'email' => 'nama.baru@example.com',
                'foto' => UploadedFile::fake()->image('avatar.jpg'),
                'current_password' => 'passwordlama123',
                'new_password' => 'passwordbaru123',
                'new_password_confirmation' => 'passwordbaru123',
            ])
            ->assertRedirect(route('profil'));

        $user->refresh();

        $this->assertSame('Nama Baru', $user->name);
        $this->assertSame('nama.baru@example.com', $user->email);
        $this->assertNotNull($user->foto_profil);
        $this->assertTrue(Hash::check('passwordbaru123', $user->password));
        $this->assertTrue(Storage::disk('public')->exists($user->foto_profil));
    }

    public function test_user_cannot_change_password_when_current_password_is_wrong(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'password' => Hash::make('passwordlama123'),
        ]);

        $this->actingAs($user)
            ->put(route('profil.update'), [
                'name' => $user->name,
                'email' => $user->email,
                'current_password' => 'salah-total',
                'new_password' => 'passwordbaru123',
                'new_password_confirmation' => 'passwordbaru123',
            ])
            ->assertSessionHasErrors('current_password');

        $user->refresh();

        $this->assertTrue(Hash::check('passwordlama123', $user->password));
    }
}
