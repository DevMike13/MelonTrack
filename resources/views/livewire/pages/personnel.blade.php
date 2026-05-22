<div>
    <div class="w-full flex justify-end items-center mb-3">
        <x-button icon="plus-sm" positive label="Add New Personnel" onclick="$openModal('newPersonnel')" />
    </div>
    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div>
                    @if (count($personnelLists) == 0)
                        <h1 class="text-center font-normal text-lg mt-5 italic text-gray-500">No data available.</h1>
                    @else
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Name</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Email</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Role</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Status</th>
                                    {{-- <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Address</th> --}}
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($personnelLists as $personnel)
                                    <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100 dark:odd:bg-neutral-800 dark:even:bg-neutral-700 dark:hover:bg-neutral-700">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            {{ $personnel->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $personnel->email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            @if ( $personnel->role === 'admin')
                                                <x-badge flat positive :label="strtoupper($personnel->role)" />
                                            @else
                                                <x-badge flat warning :label="strtoupper($personnel->role)" />
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{-- {{ $personnel->mobile_no }} --}}
                                            @if ($personnel->status === 'Active')
                                                <span class="text-green-600 font-semibold">Active</span>
                                            @else
                                                <span class="text-red-600 font-semibold">Inactive</span>
                                            @endif
                                        </td>
                                        {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $personnel->ad }}
                                        </td> --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-4">
                                            @if ($personnel->email === 'broccolimicrogreens@gmail.com')
                                                
                                            @else
                                                @if ($personnel->is_approved)
                                                    {{-- Already approved → show static status --}}
                                                    {{-- <div class="flex items-center gap-x-1 py-2 rounded-lg text-sm text-green-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>
                                                        Approved
                                                    </div> --}}
                                                @else
                                                    {{-- Not approved yet → show button to approve --}}
                                                    <a class="flex items-center gap-x-1 py-2 rounded-lg text-sm text-green-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                                    href="#"
                                                    wire:click="approvePersonnelConfirmation({{ $personnel->id }}, '{{ $personnel->name }}')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15L15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0Z" />
                                                        </svg>
                                                        Approve
                                                    </a>
                                                @endif
                                        
                                                <a class="flex items-center gap-x-1 py-2 rounded-lg text-sm text-blue-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#" onclick="$openModal('editPersonnel')" wire:click="getSelectedPersonnel({{$personnel->id}})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                    </svg>
                                                        
                                                    Edit
                                                </a>
                                
                                                <a class="flex items-center gap-x-1 py-2 rounded-lg text-sm text-red-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#" wire:click="deletePersonnelConfirmation({{$personnel->id}}, '{{$personnel->name}}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>                                                                  
                                                    Delete
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
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
