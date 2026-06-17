<div>
    
    <div class="w-full flex justify-end items-center mb-3">
        <x-button icon="plus-sm" positive label="Add New Personnel" onclick="$openModal('newPersonnel')" />
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5 mb-8 items-stretch">

        <div class="bg-[#e1eedb] border border-[#356744] p-4 sm:p-5 rounded-2xl flex flex-col gap-4 h-full">
            <div class="flex items-center justify-between gap-3">
                <div class="w-12 h-12 sm:w-14 sm:h-14 bg-[#c1ebbf] flex items-center justify-center rounded-full shrink-0">
                    <x-heroicon-o-users class="w-7 h-7 text-[#356744]" />
                </div>

                <div class="text-right">
                    <p class="font-semibold text-[#376a44] text-xs sm:text-sm">Total Users</p>
                    <p class="text-lg sm:text-2xl font-semibold">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>

        <div class="bg-green-100/60 border border-green-500 p-4 sm:p-5 rounded-2xl flex flex-col gap-4 h-full">
            <div class="flex items-center justify-between gap-3">
                <div class="w-12 h-12 sm:w-14 sm:h-14 bg-green-200 flex items-center justify-center rounded-full shrink-0">
                    <span class="text-green-700 text-xl">●</span>
                </div>

                <div class="text-right">
                    <p class="font-semibold text-green-700 text-xs sm:text-sm">Online Users</p>
                    <p class="text-lg sm:text-2xl font-semibold">{{ $onlineUsers }}</p>
                </div>
            </div>
        </div>

        <div class="bg-red-100/60 border border-red-500 p-4 sm:p-5 rounded-2xl flex flex-col gap-4 h-full">
            <div class="flex items-center justify-between gap-3">
                <div class="w-12 h-12 sm:w-14 sm:h-14 bg-red-200 flex items-center justify-center rounded-full shrink-0">
                    <span class="text-red-700 text-xl">●</span>
                </div>

                <div class="text-right">
                    <p class="font-semibold text-red-700 text-xs sm:text-sm">Offline Users</p>
                    <p class="text-lg sm:text-2xl font-semibold">{{ $offlineUsers }}</p>
                </div>
            </div>
        </div>

        <div class="bg-amber-100/60 border border-amber-500 p-4 sm:p-5 rounded-2xl flex flex-col gap-4 h-full">
            <div class="flex items-center justify-between gap-3">
                <div class="w-12 h-12 sm:w-14 sm:h-14 bg-amber-200 flex items-center justify-center rounded-full shrink-0">
                    <x-heroicon-o-clock class="w-7 h-7 text-amber-700" />
                </div>

                <div class="text-right">
                    <p class="font-semibold text-amber-700 text-xs sm:text-sm">Pending Approval</p>
                    <p class="text-lg sm:text-2xl font-semibold">{{ $pendingApprovalUsers }}</p>
                </div>
            </div>
        </div>

    </div>
    
    <div class="bg-white rounded-2xl border border-amber-500 p-4 mb-8">
        <h6 class="font-semibold text-amber-700 mb-4">Pending Approval Accounts</h6>

        @if($pendingPersonnelLists->count() == 0)
            <p class="text-center italic text-gray-500 py-8">No pending approval accounts.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Role</th>
                            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($pendingPersonnelLists as $personnel)
                            <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                    {{ $personnel->name }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                    {{ $personnel->email }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($personnel->role === 'admin')
                                        <x-badge flat positive :label="strtoupper($personnel->role)" />
                                    @else
                                        <x-badge flat warning :label="strtoupper($personnel->role)" />
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="text-amber-600 font-semibold">Pending Approval</span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-4">
                                    <a href="#"
                                        wire:click="approvePersonnelConfirmation({{ $personnel->id }}, '{{ $personnel->name }}')"
                                        class="flex items-center gap-x-1 py-2 text-sm text-green-500">
                                        <x-heroicon-o-check-circle class="w-4 h-4" />
                                        Approve
                                    </a>

                                    <a href="#"
                                        onclick="$openModal('editPersonnel')"
                                        wire:click="getSelectedPersonnel({{ $personnel->id }})"
                                        class="flex items-center gap-x-1 py-2 text-sm text-blue-500">
                                        <x-heroicon-o-pencil-square class="w-4 h-4" />
                                        Edit
                                    </a>

                                    <a href="#"
                                        wire:click="deletePersonnelConfirmation({{ $personnel->id }}, '{{ $personnel->name }}')"
                                        class="flex items-center gap-x-1 py-2 text-sm text-red-500">
                                        <x-heroicon-o-trash class="w-4 h-4" />
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="bg-white rounded-2xl border border-[#356744] p-4">
        <h6 class="font-semibold text-[#356744] mb-4">Approved Accounts</h6>

        @if($approvedPersonnelLists->count() == 0)
            <p class="text-center italic text-gray-500 py-8">No approved accounts.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Role</th>
                            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Account Status</th>
                            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Online Status</th>
                            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($approvedPersonnelLists as $personnel)
                            <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                    {{ $personnel->name }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                    {{ $personnel->email }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($personnel->role === 'admin')
                                        <x-badge flat positive :label="strtoupper($personnel->role)" />
                                    @else
                                        <x-badge flat warning :label="strtoupper($personnel->role)" />
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($personnel->status === 'Active')
                                        <span class="text-green-600 font-semibold">Active</span>
                                    @else
                                        <span class="text-red-600 font-semibold">Inactive</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm" wire:poll.5s>
                                    @if($personnel->is_online)
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-green-50 text-green-600 ring-1 ring-green-200">
                                            ● Online
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-red-50 text-red-600 ring-1 ring-red-200">
                                            ● Offline
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-4">
                                    <a href="#"
                                        onclick="$openModal('editPersonnel')"
                                        wire:click="getSelectedPersonnel({{ $personnel->id }})"
                                        class="flex items-center gap-x-1 py-2 text-sm text-blue-500">
                                        <x-heroicon-o-pencil-square class="w-4 h-4" />
                                        Edit
                                    </a>

                                    <a href="#"
                                        wire:click="deletePersonnelConfirmation({{ $personnel->id }}, '{{ $personnel->name }}')"
                                        class="flex items-center gap-x-1 py-2 text-sm text-red-500">
                                        <x-heroicon-o-trash class="w-4 h-4" />
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <x-modal blur name="newPersonnel" persistent align="center" max-width="sm">
        <form wire:submit.prevent="createNewPersonnel" class="w-full">
            <x-card title="Create New Personnel">
                
                <div>
                    <x-input right-icon="user" label="Name" placeholder="your name" wire:model="name"/>
                </div>
                <div class="mt-3">
                    <x-input class="pr-28" label="Email" placeholder="your email" suffix="@mail.com" wire:model="email"/>
                </div>

                
            
                <div class="mt-3">
                    <x-inputs.password label="Password" wire:model="password" />
                </div>

                <div class="mt-3">
                    <x-inputs.password label="Confirm Password" wire:model="password_confirmation"/>
                </div>

                <div class="mt-3">
                    <p class="text-sm font-medium">Status</p>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 w-full">
                        <div>
                            <input 
                                wire:model.live="status" 
                                type="radio" 
                                id="status-Active" 
                                name="status" 
                                value="Active" 
                                class="hidden peer"
                            >
                            <label for="status-Active"
                                class="inline-flex items-center justify-center w-full py-1 px-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-2
                                    peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 
                                    transition text-lg font-medium font-secondary">
                                Active
                            </label>
                        </div>
                        <div>
                            <input 
                                wire:model.live="status" 
                                type="radio" 
                                id="status-Inactive" 
                                name="status" 
                                value="Inactive" 
                                class="hidden peer"
                            >
                            <label for="status-Inactive"
                                class="inline-flex items-center justify-center w-full py-1 px-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-2
                                    peer-checked:border-red-600 peer-checked:text-red-600 hover:text-gray-600 hover:bg-gray-100 
                                    transition text-lg font-medium font-secondary">
                                Inactive
                            </label>
                        </div>
                    </div>
                </div>

                <x-slot name="footer" class="flex justify-end gap-x-4">
                    <div class="flex justify-end gap-x-4">
                        <x-button flat label="Cancel" x-on:click="close" wire:click="cancelCreate" />
                        <x-button primary label="Save" type="submit" />
                    </div>
                </x-slot>
            </x-card>
        </form>
    </x-modal>

    <x-modal blur name="editPersonnel" persistent align="center" max-width="sm">
        <x-card title="Edit Personnel">
            
            <div>
                <x-input right-icon="user" label="Name" placeholder="your name" wire:model="editName"/>
            </div>
            <div class="mt-3">
                <x-input class="pr-28" label="Email" placeholder="your email" suffix="@mail.com" wire:model="editEmail"/>
            </div>

            <div class="mt-3">
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 w-full">
                    <div>
                        <input 
                            wire:model.live="editStatus" 
                            type="radio" 
                            id="editStatus-Active" 
                            name="editStatus" 
                            value="Active" 
                            class="hidden peer"
                        >
                        <label for="editStatus-Active"
                            class="inline-flex items-center justify-center w-full py-1 px-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-2
                                peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 
                                transition text-lg font-medium font-secondary">
                            Active
                        </label>
                    </div>
                    <div>
                        <input 
                            wire:model.live="editStatus" 
                            type="radio" 
                            id="editStatus-Inactive" 
                            name="editStatus" 
                            value="Inactive" 
                            class="hidden peer"
                        >
                        <label for="editStatus-Inactive"
                            class="inline-flex items-center justify-center w-full py-1 px-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-2
                                peer-checked:border-red-600 peer-checked:text-red-600 hover:text-gray-600 hover:bg-gray-100 
                                transition text-lg font-medium font-secondary">
                            Inactive
                        </label>
                    </div>
                </div>
            </div>

            <x-slot name="footer" class="flex justify-end gap-x-4">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" wire:click="cancelEdit" />
                    <x-button primary label="Save" wire:click="editPersonnelConfirmation({{ $selectedPersonnelId }})" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
